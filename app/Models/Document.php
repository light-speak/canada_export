<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name 文档名称
 * @property string $type 文档类型
 * @property string $file_path 文件路径
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',             // 文档名称
        'type',             // 文档类型：business_licence, incorporation_certificate 等
        'file_path',        // 文件路径
    ];

    public const TYPE_OPTIONS = [
        'business_licence' => 'Business Licence',
        'incorporation_certificate' => 'Incorporation Certificate',
        'invoice' => 'Invoice',
        'manufacturing_statement' => 'Manufacturing Statement',
        'gmp_certificate' => 'GMP Certificate',
        'manufacturing_licence' => 'Manufacturing Licence',
        'certificate' => 'Certificate',
    ];

    public const ENABLE_TYPES = [
        'certificate' => 'Certificate',
    ];

} 