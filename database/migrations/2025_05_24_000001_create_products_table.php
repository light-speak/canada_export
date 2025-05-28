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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('用户ID');
            $table->string('name')->comment('产品名称');
            $table->string('manufacturer')->comment('制造商');
            $table->text('description')->nullable()->comment('描述');
            $table->string('status')->default('active')->comment('状态');

            $table->string('sku_code')->nullable()->comment('SKU码');
            $table->string('hs_code')->nullable()->comment('HS码');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}; 