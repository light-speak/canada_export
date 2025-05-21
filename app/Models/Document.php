<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',             // 文档类型：business_licence, incorporation_certificate 等
        'file_name',        // 文件名
        'file_path',        // 文件路径
        'mime_type',        // MIME类型
        'size',             // 文件大小
        'upload_date',      // 上传日期
        'company_id',       // 所属公司
        'user_id'           // 上传者
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'upload_date' => 'datetime',
        'size' => 'integer'
    ];

    /**
     * Get the company that owns the document.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that uploaded the document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 