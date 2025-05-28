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
        Schema::create('sub_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('role')->default('user'); // 可以是 'user', 'admin', 'readonly' 等
            $table->text('permissions')->nullable(); // JSON 格式存储的特定权限
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // 确保一个用户只能被添加为特定父用户的子账户一次
            $table->unique(['parent_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_accounts');
    }
};
