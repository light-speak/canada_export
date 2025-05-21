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
            $table->string('name');
            $table->string('website')->nullable();
            $table->text('registered_address');
            $table->string('building_suite')->nullable();
            $table->text('operations_address')->nullable();
            
            // 法律信息
            $table->string('business_licence_number')->nullable();
            $table->date('licence_expiry_date')->nullable();
            $table->string('incorporation_id')->nullable();
            $table->boolean('is_manufacturer')->default(false);
            $table->boolean('is_chamber_member')->default(false);
            
            // 其他信息
            $table->string('chamber_name')->default('Boulder Chamber of Commerce');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->foreignId('user_id')->constrained();
            $table->date('approval_date')->nullable();
            
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
