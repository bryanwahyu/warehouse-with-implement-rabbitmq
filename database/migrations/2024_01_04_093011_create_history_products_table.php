<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Produksi\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class, 'product_id')->constrained()->cascadeOnDelete();
            $table->string('tipe');
            $table->bigInteger('tipe_id')->nullable();
            $table->double('jumlah');
            $table->string('nama');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_products');
    }
};
