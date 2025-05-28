<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            // 基本信息
            $table->string('name')->comment('公司名称');
            $table->string('website')->nullable()->comment('公司网站');
            $table->text('registered_address')->comment('注册地址');
            $table->string('building_suite')->nullable()->comment('楼层房间号');
            $table->text('operations_address')->nullable()->comment('运营地址');
            
            // 法律信息
            $table->string('business_licence_number')->nullable()->comment('营业执照号');
            $table->date('licence_expiry_date')->nullable()->comment('营业执照到期日期');
            $table->string('incorporation_id')->nullable()->comment('公司注册号');
            
            // 其他信息
            $table->string('status')->default('pending')->comment('状态'); // pending, approved, rejected
            $table->unsignedBigInteger('user_id')->index()->comment('用户ID');
            $table->date('approval_date')->nullable()->comment('批准日期');
            $table->text('rejection_reason')->nullable()->comment('拒绝原因');

            $table->json('company_types')->nullable()->comment('公司类型');
            $table->json('chamber_memberships')->nullable()->comment('商会会员');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
