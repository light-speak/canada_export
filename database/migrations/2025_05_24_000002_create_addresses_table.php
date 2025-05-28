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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('用户ID');
            $table->string('name')->comment('地址名称');
            $table->string('street')->comment('街道');
            $table->string('city')->comment('城市');
            $table->string('state')->comment('州');
            $table->string('zip')->comment('邮编');
            $table->string('country')->default('USA')->comment('国家');
            $table->boolean('is_default')->default(false)->comment('是否默认地址');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
}; 