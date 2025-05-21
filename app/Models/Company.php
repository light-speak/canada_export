<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 基本信息
        'name',                    // 公司名称
        'website',                 // 网站URL
        'registered_address',      // 注册地址
        'building_suite',          // 建筑/套房号
        'operations_address',      // 运营地址（可选）
        
        // 法律信息
        'business_licence_number', // 有效商业许可证号码
        'licence_expiry_date',     // 许可证到期日期
        'incorporation_id',        // 联邦/州公司注册ID号码
        'is_manufacturer',         // 是否为制造商
        'is_chamber_member',       // 是否为商会成员
        
        // 其他信息
        'chamber_name',            // 商会名称
        'status',                  // 状态：pending, approved, rejected
        'rejection_reason',        // 拒绝原因
        'user_id',                 // 所属用户
        'approval_date'            // 批准日期
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'licence_expiry_date' => 'date',
        'approval_date' => 'date',
        'is_manufacturer' => 'boolean',
        'is_chamber_member' => 'boolean'
    ];

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the certificates that belong to the company.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    
    /**
     * Get the contacts for the company.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
    /**
     * Get the primary contact for the company.
     */
    public function primaryContact()
    {
        return $this->hasOne(Contact::class)->where('is_primary', true);
    }
    
    /**
     * Get the documents for the company.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
} 