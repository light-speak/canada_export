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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('名');
            $table->string('last_name')->comment('姓');
            $table->string('job_title')->nullable()->comment('职位');
            $table->string('phone')->comment('电话');
            $table->string('email')->comment('邮箱');
            $table->boolean('is_primary')->default(false)->comment('是否主联系人');
            $table->unsignedBigInteger('company_id')->index()->comment('公司ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
