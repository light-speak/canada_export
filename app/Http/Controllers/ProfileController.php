<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Services\RoleService;

class ProfileController extends Controller
{
    /**
     * 显示用户个人资料
     */
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.profile.show', compact('user'));
    }
    
    /**
     * 更新个人资料
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
    
    /**
     * 显示修改密码表单
     */
    public function editPassword()
    {
        return view('dashboard.profile.edit-password');
    }
    
    /**
     * 更新密码
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('profile.show')->with('success', 'Password changed successfully.');
    }
    
    /**
     * 显示子账户列表
     */
    public function subAccounts()
    {
        // 只有主账户可以管理子账户
        if (!RoleService::isPrimaryAccount(Auth::user())) {
            abort(403, 'You do not have permission to manage sub-accounts.');
        }
        
        $user = Auth::user();
        $subAccounts = $user->subAccounts()->with('user')->get();
        
        return view('dashboard.profile.sub-accounts', compact('subAccounts'));
    }
    
    /**
     * 显示添加子账户表单
     */
    public function createSubAccount()
    {
        // 只有主账户可以添加子账户
        if (!RoleService::isPrimaryAccount(Auth::user())) {
            abort(403, 'You do not have permission to create sub-accounts.');
        }
        
        return view('dashboard.profile.create-sub-account');
    }
    
    /**
     * 添加子账户
     */
    public function storeSubAccount(Request $request)
    {
        // 只有主账户可以添加子账户
        if (!RoleService::isPrimaryAccount(Auth::user())) {
            abort(403, 'You do not have permission to create sub-accounts.');
        }
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:user,admin,readonly',
        ]);
        
        $subUser = User::where('email', $request->email)->first();
        
        // 不能添加自己为子账户
        if ($subUser->id === Auth::id()) {
            return back()->withErrors(['email' => 'You cannot add yourself as a sub-account.']);
        }
        
        // 检查是否已经是子账户
        $existingSubAccount = SubAccount::where('parent_id', Auth::id())
            ->where('user_id', $subUser->id)
            ->first();
            
        if ($existingSubAccount) {
            return back()->withErrors(['email' => 'This user is already a sub-account.']);
        }
        
        SubAccount::create([
            'parent_id' => Auth::id(),
            'user_id' => $subUser->id,
            'role' => $request->role,
        ]);
        
        return redirect()->route('profile.sub-accounts')
            ->with('success', 'Sub-account added successfully.');
    }
    
    /**
     * 更新子账户角色
     */
    public function updateSubAccount(Request $request, SubAccount $subAccount)
    {
        // 只有主账户可以更新子账户
        if (!RoleService::isPrimaryAccount(Auth::user())) {
            abort(403, 'You do not have permission to update sub-accounts.');
        }
        
        // 验证当前用户是否有权限修改此子账户
        if ($subAccount->parent_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'role' => 'required|in:user,admin,readonly',
        ]);
        
        $subAccount->update([
            'role' => $request->role,
        ]);
        
        return redirect()->route('profile.sub-accounts')
            ->with('success', 'Sub-account updated successfully.');
    }
    
    /**
     * 删除子账户
     */
    public function destroySubAccount(SubAccount $subAccount)
    {
        // 只有主账户可以删除子账户
        if (!RoleService::isPrimaryAccount(Auth::user())) {
            abort(403, 'You do not have permission to delete sub-accounts.');
        }
        
        // 验证当前用户是否有权限删除此子账户
        if ($subAccount->parent_id !== Auth::id()) {
            abort(403);
        }
        
        $subAccount->delete();
        
        return redirect()->route('profile.sub-accounts')
            ->with('success', 'Sub-account removed successfully.');
    }
}
