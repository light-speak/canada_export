<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            // 删除原有的单选字段
            $table->dropColumn(['is_manufacturer', 'is_chamber_member', 'chamber_name']);
            
            // 添加新的JSON字段来存储多选值
            $table->json('company_types')->nullable()->after('incorporation_id');
            $table->json('chamber_memberships')->nullable()->after('company_types');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('is_manufacturer')->default(false);
            $table->boolean('is_chamber_member')->default(false);
            $table->string('chamber_name')->nullable();
            
            $table->dropColumn(['company_types', 'chamber_memberships']);
        });
    }
}; 