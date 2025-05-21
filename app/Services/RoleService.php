<?php

namespace App\Services;

use App\Models\User;
use App\Models\SubAccount;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    /**
     * 检查用户是否具有特定角色
     *
     * @param User $user
     * @param string|array $roles
     * @return bool
     */
    public static function hasRole($user, $roles)
    {
        // 转换为数组以便于处理
        if (!is_array($roles)) {
            $roles = [$roles];
        }
        
        // 检查用户是否是子账户
        $isSubAccount = $user->parentAccounts()->exists();
        
        if ($isSubAccount) {
            // 获取子账户信息
            $subAccount = $user->parentAccounts()->first();
            
            // 检查子账户的角色是否在允许的角色列表中
            return in_array($subAccount->role, $roles);
        }
        
        // 主账户默认拥有所有权限
        return true;
    }
    
    /**
     * 检查用户是否为主账户(非子账户)
     *
     * @param User $user
     * @return bool
     */
    public static function isPrimaryAccount($user)
    {
        return !$user->parentAccounts()->exists();
    }
    
    /**
     * 检查用户是否有编辑权限
     *
     * @param User $user
     * @return bool
     */
    public static function canEdit($user)
    {
        // 主账户或admin/user角色可以编辑
        return self::isPrimaryAccount($user) || self::hasRole($user, ['admin', 'user']);
    }
    
    /**
     * 检查用户是否有只读权限
     *
     * @param User $user
     * @return bool
     */
    public static function isReadOnly($user)
    {
        return !self::isPrimaryAccount($user) && self::hasRole($user, 'readonly');
    }
    
    /**
     * 检查当前用户是否可以管理子账户
     *
     * @return bool
     */
    public static function canManageSubAccounts()
    {
        return self::isPrimaryAccount(Auth::user());
    }
} 