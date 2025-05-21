<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubAccount;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 验证用户是否已登录
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // 检查用户是否是子账户
        $isSubAccount = $user->parentAccounts()->exists();
        
        if ($isSubAccount) {
            // 获取子账户信息
            $subAccount = $user->parentAccounts()->first();
            
            // 检查子账户的角色是否在允许的角色列表中
            if ($roles && !in_array($subAccount->role, $roles)) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // 主账户(Administrator)拥有所有权限
            return $next($request);
        }

        return $next($request);
    }
} 