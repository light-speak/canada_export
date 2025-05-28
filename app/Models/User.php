<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Certificate> $certificates
 * @property-read int|null $certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $childUsers
 * @property-read int|null $child_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubAccount> $parentAccounts
 * @property-read int|null $parent_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $parentUsers
 * @property-read int|null $parent_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubAccount> $subAccounts
 * @property-read int|null $sub_accounts_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
    public function companies(): HasMany
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
     * Get the certificates that belong to the user.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
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

    /**
     * Get the products that belong to the user.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the addresses that belong to the user.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
