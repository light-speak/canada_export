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
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('address_id')->index();
            $table->string('destination_country');
            $table->string('certificate_type');
            $table->text('purpose');
            $table->integer('copies')->default(1);
            $table->string('language')->default('english');
            $table->boolean('is_manufacturer')->default(false);
            $table->string('invoice_path');
            $table->string('manufacturing_statement_path');
            $table->string('delivery_type');
            $table->string('shipping_method');
            $table->string('status')->default('pending_payment');
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