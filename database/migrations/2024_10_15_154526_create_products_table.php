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
            $table->uuid('id')->primary();
            $table->foreignUuid('product_type_id')->nullable();
            $table->foreignUuid('discount_id')->nullable();
            $table->foreignUuid('inventory_id')->nullable();
            $table->string('name');
            $table->longText('photo')->nullable();
            $table->longText('code')->nullable();
            $table->string('SKU')->nullable(); // Stock Keeping Unit
            $table->decimal('price',10,2);
            $table->decimal('sale_price',10,2);
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('products');
    }
};
