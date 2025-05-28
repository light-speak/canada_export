<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RoleService;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates
     */
    public function index()
    {
        $certificates = Auth::user()->certificates()
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dashboard.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating basic certificate info
     */
    public function createBasicInfo()
    {
        // Check if user has permission to create certificates
        if (RoleService::isReadOnly(Auth::user())) {
            abort(403, 'You do not have permission to create certificates.');
        }

        // Get user's approved companies
        $companies = Auth::user()->companies()->where('status', 'approved')->get();

        return view('dashboard.certificates.create.basic_info', compact('companies'));
    }

    /**
     * Store basic certificate info
     */
    public function storeBasicInfo(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'destination_country' => 'required|string|in:canada,mexico,united_states,china,japan,south_korea,india,indonesia,malaysia,singapore,thailand,vietnam,france,germany,italy,spain,united_kingdom,netherlands,switzerland,sweden,saudi_arabia,uae,qatar,kuwait,australia,new_zealand,brazil,argentina,chile,colombia',
            'certificate_type' => 'required|string|in:free_sale,gmp',
        ]);

        // Verify that the company belongs to the user and is approved
        $company = Auth::user()->companies()
            ->where('id', $validated['company_id'])
            ->where('status', 'approved')
            ->firstOrFail();

        // 如果是保存草稿
        if ($request->has('save_draft')) {
            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => [
                    'basic_info' => $validated
                ],
                'current_step' => 1
            ]);

            return redirect()->route('certificates.index')
                ->with('success', '证书草稿已保存');
        }

        // 存储到 session 中继续下一步
        $request->session()->put('certificate.basic_info', $validated);

        return redirect()->route('certificates.create.products');
    }

    /**
     * Show the form for selecting products
     */
    public function createProducts(Request $request)
    {
        if (!$request->session()->has('certificate.basic_info')) {
            return redirect()->route('certificates.create.basic_info');
        }

        // 检查是否有草稿
        if (request()->has('draft_id')) {
            $certificate = Certificate::findOrFail(request()->draft_id);
            session(['certificate_form' => $certificate->form_data]);
        }

        $products = Product::where('user_id', Auth::id())->get();
        return view('dashboard.certificates.create.products', compact('products'));
    }

    /**
     * Store selected products
     */
    public function storeProducts(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id'
        ]);

        if ($request->has('save_draft')) {
            $formData = session('certificate_form', []);
            $formData['products'] = $validated['products'];

            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => $formData,
                'current_step' => 2
            ]);

            return redirect()->route('certificates.index')
                ->with('success', '证书草稿已保存');
        }

        $request->session()->put('certificate.products', $validated['products']);

        return redirect()->route('certificates.create.options');
    }

    /**
     * Show the form for certificate options
     */
    public function createOptions(Request $request)
    {
        if (!$request->session()->has('certificate.products')) {
            return redirect()->route('certificates.create.products');
        }

        return view('dashboard.certificates.create.options');
    }

    /**
     * Store certificate options
     */
    public function storeOptions(Request $request)
    {
        $validated = $request->validate([
            'copies' => 'required|integer|min:1|max:10',
            'language' => 'required|string|in:english,english_spanish,english_arabic',
            'is_manufacturer' => 'required|boolean',
            'custom_wording' => 'nullable|string|max:1000',
        ]);

        if ($request->has('save_draft')) {
            $formData = session('certificate_form', []);
            $formData['options'] = $validated;

            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => $formData,
                'current_step' => 3
            ]);

            return redirect()->route('certificates.index')
                ->with('success', 'Certificate draft saved');
        }

        $request->session()->put('certificate.options', $validated);
        return redirect()->route('certificates.create.documents');
    }

    /**
     * Show the form for document upload
     */
    public function createDocuments(Request $request)
    {
        if (!$request->session()->has('certificate.options')) {
            return redirect()->route('certificates.create.options');
        }

        return view('dashboard.certificates.create.documents');
    }

    /**
     * Store uploaded documents
     */
    public function storeDocuments(Request $request)
    {
        $validated = $request->validate([
            'invoice' => 'required|file|mimes:pdf|max:51200', // 50MB max
            'manufacturing_statement' => 'required|file|mimes:pdf|max:51200',
        ]);

        $documents = [];

        // Process invoice
        if ($request->hasFile('invoice')) {
            $documents['invoice'] = $this->processDocument($request->file('invoice'), 'invoice');
        }

        // Process manufacturing statement
        if ($request->hasFile('manufacturing_statement')) {
            $documents['manufacturing_statement'] = $this->processDocument($request->file('manufacturing_statement'), 'manufacturing_statement');
        }

        if ($request->has('save_draft')) {
            $formData = session('certificate_form', []);
            $formData['documents'] = $documents;

            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => $formData,
                'current_step' => 4
            ]);

            return redirect()->route('certificates.index')
                ->with('success', '证书草稿已保存');
        }

        // Store document info in session
        $request->session()->put('certificate.documents', $documents);
        return redirect()->route('certificates.create.delivery');
    }

    /**
     * Process document upload
     */
    private function processDocument($file, $type)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        // Store file with unique name in certificates/documents folder
        $path = $file->storeAs(
            'certificates/documents', 
            uniqid() . '_' . time() . '.' . $extension, 
            'public'
        );
        
        return [
            'type' => $type,
            'file_name' => $originalName,
            'file_path' => $path,
        ];
    }

    /**
     * Show the form for delivery options
     */
    public function createDelivery(Request $request)
    {
        if (!$request->session()->has('certificate.documents')) {
            return redirect()->route('certificates.create.documents');
        }

        $addresses = Auth::user()->addresses;
        return view('dashboard.certificates.create.delivery', compact('addresses'));
    }

    /**
     * Store delivery options
     */
    public function storeDelivery(Request $request)
    {
        $validated = $request->validate([
            'delivery_type' => 'required|in:mail_only,mail_and_digital',
            'shipping_method' => 'required|in:usps_first,usps_priority,usps_express,fedex_ground,fedex_express',
            'address_id' => 'required|exists:addresses,id',
        ]);

        // Verify that the address belongs to the user
        $address = Auth::user()->addresses()->findOrFail($validated['address_id']);

        $deliveryData = [
            'delivery_type' => $validated['delivery_type'],
            'shipping_method' => $validated['shipping_method'],
            'address_id' => $validated['address_id'],
            'shipping_address' => $address->full_address
        ];

        if ($request->has('save_draft')) {
            $formData = session('certificate_form', []);
            $formData['delivery'] = $deliveryData;

            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => $formData,
                'current_step' => 5
            ]);

            return redirect()->route('certificates.index')
                ->with('success', '证书草稿已保存');
        }

        // Store delivery info in session
        $request->session()->put('certificate.delivery', $deliveryData);
        return redirect()->route('certificates.create.summary');
    }

    /**
     * Display the specified certificate
     */
    public function show(Certificate $certificate)
    {
        // Check if user owns the certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to view this certificate.');
        }

        return view('dashboard.certificates.show', compact('certificate'));
    }

    /**
     * Show the summary page
     */
    public function createSummary(Request $request)
    {
        // Check if all required session data exists
        if (!$request->session()->has(['certificate.basic_info', 'certificate.products', 'certificate.options', 'certificate.documents', 'certificate.delivery'])) {
            return redirect()->route('certificates.create.delivery');
        }

        // Get all data from session
        $basicInfo = $request->session()->get('certificate.basic_info');
        $products = $request->session()->get('certificate.products');
        $options = $request->session()->get('certificate.options');
        $documents = $request->session()->get('certificate.documents');
        $delivery = $request->session()->get('certificate.delivery');

        return view('dashboard.certificates.create.summary', compact('basicInfo', 'products', 'options', 'documents', 'delivery'));
    }

    public function storeSummary(Request $request)
    {
        if ($request->has('save_draft')) {
            $formData = session('certificate_form', []);
            
            $certificate = Certificate::create([
                'user_id' => Auth::id(),
                'status' => 'draft',
                'form_data' => $formData,
                'current_step' => 6
            ]);

            return redirect()->route('certificates.index')
                ->with('success', '证书草稿已保存');
        }

        // 最终提交
        $formData = session('certificate_form');
        
        $certificate = Certificate::create([
            'user_id' => Auth::id(),
            'status' => 'submitted',
            'form_data' => $formData,
            'company_id' => $formData['basic_info']['company_id'],
            'certificate_type' => $formData['basic_info']['certificate_type'],
            'destination_country' => $formData['basic_info']['destination_country'],
            'copies' => $formData['options']['copies'],
            'language' => $formData['options']['language'],
            'is_manufacturer' => $formData['options']['is_manufacturer'],
            'custom_wording' => $formData['options']['custom_wording'] ?? null,
            'delivery_type' => $formData['delivery']['delivery_type'],
            'shipping_method' => $formData['delivery']['shipping_method'],
            'shipping_address' => $formData['delivery']['shipping_address'],
        ]);

        // 关联产品
        foreach ($formData['products'] as $product) {
            $certificate->products()->attach($product['id'], [
                'quantity' => $product['quantity'] ?? 1,
                'unit' => $product['unit'] ?? 'piece'
            ]);
        }

        session()->forget('certificate_form');
        
        return redirect()->route('certificates.show', $certificate)
            ->with('success', '证书申请已提交');
    }

    public function resumeDraft(Certificate $certificate)
    {
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        // 根据当前步骤重定向到对应页面
        $steps = [
            1 => 'certificates.create.basic_info',
            2 => 'certificates.create.products',
            3 => 'certificates.create.options',
            4 => 'certificates.create.documents',
            5 => 'certificates.create.delivery',
            6 => 'certificates.create.summary'
        ];

        $nextStep = $steps[$certificate->current_step] ?? 'certificates.create.basic_info';

        // 将草稿数据存入 session
        session(['certificate_form' => $certificate->form_data]);

        return redirect()->route($nextStep, ['draft_id' => $certificate->id]);
    }
} 