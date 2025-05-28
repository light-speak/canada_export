<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $parent_id
 * @property int $user_id
 * @property string $role
 * @property array<array-key, mixed>|null $permissions
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $parent
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereUserId($value)
 * @mixin \Eloquent
 */
class SubAccount extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'role',
        'permissions',
        'is_active',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'permissions' => 'array',
        'is_active' => 'boolean',
    ];
    
    /**
     * 获取父用户
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    
    /**
     * 获取子用户
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
