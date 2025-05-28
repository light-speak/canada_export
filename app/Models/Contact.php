<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $first_name 名
 * @property string $last_name 姓
 * @property string|null $job_title 职位
 * @property string $phone 电话
 * @property string $email 邮箱
 * @property bool $is_primary 是否主联系人
 * @property int $company_id 公司ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'phone',
        'email',
        'is_primary',
        'company_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the company that owns the contact.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
} 