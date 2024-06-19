<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Produksi\Models\Satuan\SatuanProduct;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CategoryProduct::class, 'category_product_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SatuanProduct::class, 'satuan_product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('name');
            $table->double('stok');
            $table->integer('time_product')->default(0);
            $table->double('harga');
            $table->string('foto')->nullable();
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
