<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
