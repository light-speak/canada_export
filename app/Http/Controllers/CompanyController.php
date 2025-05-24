<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\RoleService;

class CompanyController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * 显示用户的所有公司
     */
    public function index()
    {
        $companies = Auth::user()->companies;
        return view('dashboard.companies.index', compact('companies'));
    }
    
    /**
     * 显示创建公司的基本信息表单
     */
    public function createBasicInfo()
    {
        // 验证用户是否有创建公司的权限
        if (RoleService::isReadOnly(Auth::user())) {
            abort(403, 'You do not have permission to create companies.');
        }
        
        return view('dashboard.companies.create.basic_info');
    }
    
    /**
     * 保存基本信息，进入法律信息表单
     */
    public function storeBasicInfo(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:128',
            'website' => 'nullable|url',
            'registered_address' => 'required|string',
            'building_suite' => 'nullable|string',
            'operations_address' => 'nullable|string',
        ]);
        
        // 保存到会话中，稍后会创建公司记录
        session(['company_basic_info' => $data]);
        
        return redirect()->route('companies.create.legal_info');
    }
    
    /**
     * 显示法律信息表单
     */
    public function createLegalInfo()
    {
        // 如果没有完成基本信息步骤，返回
        if (!session('company_basic_info')) {
            return redirect()->route('companies.create.basic_info');
        }
        
        return view('dashboard.companies.create.legal_info');
    }
    
    /**
     * 保存法律信息，进入联系人信息表单
     */
    public function storeLegalInfo(Request $request)
    {
        $data = $request->validate([
            'business_licence_number' => 'nullable|string',
            'licence_expiry_date' => 'nullable|date',
            'incorporation_id' => 'nullable|string',
            'company_types' => 'nullable|array',
            'company_types.*' => 'in:manufacturer,exporter_trader',
            'chamber_memberships' => 'nullable|array',
            'chamber_memberships.*' => 'in:wtc_miami,fcbf',
        ]);
        
        // 保存到会话中
        session(['company_legal_info' => $data]);
        
        return redirect()->route('companies.create.contacts');
    }
    
    /**
     * 显示联系人信息表单
     */
    public function createContacts()
    {
        // 如果没有完成前面步骤，返回
        if (!session('company_legal_info')) {
            return redirect()->route('companies.create.legal_info');
        }
        
        return view('dashboard.companies.create.contacts');
    }
    
    /**
     * 保存联系人信息，进入文档上传表单
     */
    public function storeContacts(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'job_title' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);
        
        // 设为主要联系人
        $data['is_primary'] = true;
        
        // 保存到会话中
        session(['company_primary_contact' => $data]);
        
        return redirect()->route('companies.create.documents');
    }
    
    /**
     * 显示文档上传表单
     */
    public function createDocuments()
    {
        // 如果没有完成前面步骤，返回
        if (!session('company_primary_contact')) {
            return redirect()->route('companies.create.contacts');
        }
        
        return view('dashboard.companies.create.documents');
    }
    
    /**
     * 保存文档信息，进入摘要页面
     */
    public function storeDocuments(Request $request)
    {
        $request->validate([
            'business_licence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200',
            'manufacturing_licence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200',
            'gmp_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200',
        ]);
        
        $documents = [];
        
        // 处理营业执照
        if ($request->hasFile('business_licence')) {
            $documents[] = $this->processDocument($request->file('business_licence'), 'business_licence');
        }
        
        // 如果是制造商，处理额外的文档
        if (session('company_legal_info.company_types') && in_array('manufacturer', session('company_legal_info.company_types'))) {
            if ($request->hasFile('manufacturing_licence')) {
                $documents[] = $this->processDocument($request->file('manufacturing_licence'), 'manufacturing_licence');
            }
            
            if ($request->hasFile('gmp_certificate')) {
                $documents[] = $this->processDocument($request->file('gmp_certificate'), 'gmp_certificate');
            }
        }
        
        // 保存到会话中
        session(['company_documents' => $documents]);
        
        return redirect()->route('companies.create.summary');
    }
    
    /**
     * 处理文档上传
     */
    private function processDocument($file, $type)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        // 文件将以随机文件名存储在 company_documents 文件夹
        $path = $file->storeAs(
            'company_documents', 
            uniqid() . '_' . time() . '.' . $extension, 
            'public'
        );
        
        return [
            'type' => $type,
            'file_name' => $originalName,
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ];
    }
    
    /**
     * 显示创建公司的摘要信息
     */
    public function createSummary()
    {
        // 如果没有完成前面步骤，返回
        if (!session('company_documents') && !session('company_primary_contact')) {
            return redirect()->route('companies.create.documents');
        }
        
        $basicInfo = session('company_basic_info');
        $legalInfo = session('company_legal_info');
        $primaryContact = session('company_primary_contact');
        $documents = session('company_documents', []);
        
        return view('dashboard.companies.create.summary', compact('basicInfo', 'legalInfo', 'primaryContact', 'documents'));
    }
    
    /**
     * 完成公司创建过程，保存所有信息到数据库
     */
    public function store()
    {
        // 验证用户是否有创建公司的权限
        if (RoleService::isReadOnly(Auth::user())) {
            abort(403, 'You do not have permission to create companies.');
        }
        
        // 获取所有会话数据
        $basicInfo = session('company_basic_info');
        $legalInfo = session('company_legal_info', []);
        $primaryContact = session('company_primary_contact');
        $documents = session('company_documents', []);
        
        // 创建公司记录
        $companyData = array_merge($basicInfo, $legalInfo);
        $companyData['user_id'] = Auth::id();
        $companyData['status'] = 'pending';
        
        $company = Company::create($companyData);
        
        // 创建主要联系人
        $primaryContact['company_id'] = $company->id;
        Contact::create($primaryContact);
        
        // 保存文档
        foreach ($documents as $doc) {
            $doc['company_id'] = $company->id;
            $doc['user_id'] = Auth::id();
            $doc['upload_date'] = now();
            Document::create($doc);
        }
        
        // 清除会话数据
        session()->forget([
            'company_basic_info',
            'company_legal_info',
            'company_primary_contact',
            'company_documents'
        ]);
        
        // 跳转到公司Dashboard首页
        return redirect()->route('console')
            ->with('success', 'Company information submitted successfully! Your application is pending review, and you will be notified via email once a decision has been made.');
    }
    
    /**
     * 显示公司详情
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);
        
        $contacts = $company->contacts;
        $documents = $company->documents;
        
        // 获取用户角色信息，传递给视图以控制UI显示
        $canEdit = RoleService::canEdit(Auth::user());
        
        return view('dashboard.companies.show', compact('company', 'contacts', 'documents', 'canEdit'));
    }

    /**
     * 删除公司
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        
        // 验证用户是否有删除权限
        if (RoleService::isReadOnly(Auth::user())) {
            abort(403, 'You do not have permission to delete companies.');
        }
        
        // 删除相关联系人
        $company->contacts()->delete();
        
        // 删除相关文档
        $company->documents()->delete();
        
        // 删除公司本身
        $company->delete();
        
        return redirect()->route('companies.index')
            ->with('success', 'Company has been deleted successfully.');
    }

    // /**
    //  * 审核公司申请（预留接口）
    //  * 
    //  * 建议实现以下功能：
    //  * 1. 审核员查看待审核公司列表
    //  * 2. 审核员查看公司详情
    //  * 3. 审核员批准/拒绝公司申请
    //  * 4. 发送邮件通知申请结果
    //  * 5. 更新公司状态（approved/rejected）
    //  */
    // public function approve(Company $company)
    // {
    //     // 授权检查
    //     $this->authorize('approve', $company);
        
    //     // 更新公司状态
    //     $company->update(['status' => 'approved']);
        
    //     //TODO: 发送审核通过邮件
        
    //     return redirect()->back()->with('success', 'Company application has been approved.');
    // }

    // public function reject(Company $company, Request $request)
    // {
    //     // 授权检查
    //     $this->authorize('reject', $company);
        
    //     // 验证拒绝原因
    //     $data = $request->validate(['reason' => 'required|string']);
        
    //     // 更新公司状态
    //     $company->update([
    //         'status' => 'rejected', 
    //         'rejection_reason' => $data['reason']
    //     ]);
        
    //     // 发送拒绝邮件
    //     // TODO: 添加邮件发送逻辑
        
    //     // 返回响应
    //     return redirect()->back()->with('success', 'Company application has been rejected.');
    // }
} 