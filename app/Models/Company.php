<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $website
 * @property string $registered_address
 * @property string|null $building_suite
 * @property string|null $operations_address
 * @property string|null $business_licence_number
 * @property \Illuminate\Support\Carbon|null $licence_expiry_date
 * @property string|null $incorporation_id
 * @property array<array-key, mixed>|null $company_types
 * @property array<array-key, mixed>|null $chamber_memberships
 * @property string $status
 * @property string|null $rejection_reason
 * @property int $user_id
 * @property string|null $approval_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Certificate> $certificates
 * @property-read int|null $certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\Contact|null $primaryContact
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereApprovalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereBuildingSuite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereBusinessLicenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereChamberMemberships($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIncorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereLicenceExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereOperationsAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereRegisteredAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereWebsite($value)
 * @mixin \Eloquent
 */
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
        'company_types',           // 公司类型
        'chamber_memberships',     // 商会成员
        
        // 其他信息
        'status',                  // 状态：pending, approved, rejected
        'rejection_reason',        // 拒绝原因
        'user_id',                 // 所属用户
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'company_types' => 'array',
        'chamber_memberships' => 'array',
        'licence_expiry_date' => 'date',
    ];

    public static function getCompanyStatus()
    {
        return [
            'pending',
            'approved',
            'rejected',
        ];
    }
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

    // 辅助方法
    public function isManufacturer()
    {
        return in_array('manufacturer', $this->company_types ?? []);
    }

    public function isExporterTrader()
    {
        return in_array('exporter_trader', $this->company_types ?? []);
    }

    public function isMemberOf($chamber)
    {
        return in_array($chamber, $this->chamber_memberships ?? []);
    }
} 