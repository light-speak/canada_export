<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the companies that belong to the user.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    
    /**
     * Get the documents that belong to the user.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
    /**
     * 获取该用户创建的所有子账户关系
     */
    public function subAccounts()
    {
        return $this->hasMany(SubAccount::class, 'parent_id');
    }
    
    /**
     * 获取该用户作为子账户的所有关系
     */
    public function parentAccounts()
    {
        return $this->hasMany(SubAccount::class, 'user_id');
    }
    
    /**
     * 获取所有子用户
     */
    public function childUsers()
    {
        return $this->hasManyThrough(
            User::class,
            SubAccount::class,
            'parent_id', // SubAccount表的外键
            'id',        // User表的本地键
            'id',        // 本地键
            'user_id'    // SubAccount表的本地键
        );
    }
    
    /**
     * 获取所有父用户
     */
    public function parentUsers()
    {
        return $this->hasManyThrough(
            User::class,
            SubAccount::class,
            'user_id',   // SubAccount表的外键
            'id',        // User表的本地键
            'id',        // 本地键
            'parent_id'  // SubAccount表的本地键
        );
    }
}
