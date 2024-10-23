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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('site_name');
            $table->string('timezone');
            $table->string('date_format');
            $table->string('time_format');
            $table->string('currency');
            $table->string('language');
            $table->string('site_logo')->nullable();
            $table->longText('sale_invoice_footer_text')->nullable();
            $table->longText('invoice_terms_and_condition')->nullable();
            $table->string('prefix_product_category');
            $table->string('prefix_supplier');
            $table->string('prefix_purchase_return');
            $table->string('prefix_sale');
            $table->string('prefix_expense');
            $table->string('prefix_product');
            $table->string('prefix_purchase');
            $table->string('prefix_customer');
            $table->string('prefix_sale_return');
            $table->foreignUuid('created_by')->nullable();
            $table->foreignUuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
