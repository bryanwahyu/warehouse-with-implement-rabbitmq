<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Bahan\Models\Bahan;
use Infra\PurchaseOrder\Models\PurchaseOrder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PurchaseOrder::class, 'purchase_order_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Bahan::class, 'bahan_id')->constrained()->cascadeOnDelete();
            $table->double('price');
            $table->double('stok_order');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_purchase_orders');
    }
};
