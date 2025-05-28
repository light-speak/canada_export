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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('用户ID');
            $table->unsignedBigInteger('address_id')->index()->comment('地址ID');
            $table->string('destination_country')->comment('目的地国家');
            $table->string('certificate_type')->comment('证书类型');
            $table->text('purpose')->comment('用途');
            $table->integer('copies')->default(1)->comment('副本数量');
            $table->string('language')->default('english')->comment('语言');
            $table->boolean('is_manufacturer')->default(false)->comment('是否制造商');
            $table->string('invoice_path')->comment('发票路径');
            $table->string('manufacturing_statement_path')->comment('制造声明路径');
            $table->string('delivery_type')->comment('交货类型');
            $table->string('shipping_method')->comment('运输方式');
            $table->string('status')->default('pending_payment')->comment('状态');
            $table->json('form_data')->nullable()->comment('表单数据'); // 存储表单数据
            $table->integer('current_step')->default(1)->comment('当前步骤'); // 当前步骤
            $table->timestamps();
        });

        Schema::create('certificate_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('certificate_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->timestamps();

            $table->unique(['certificate_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_products');
        Schema::dropIfExists('certificates');
    }
}; 