<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Produksi\Models\Product;
use Infra\SalesOrder\Model\SalesOrder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SalesOrder::class, 'sales_order_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class, 'product_id')->constrained()->cascadeOnDelete();
            $table->double('jumlah');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sales_orders');
    }
};
