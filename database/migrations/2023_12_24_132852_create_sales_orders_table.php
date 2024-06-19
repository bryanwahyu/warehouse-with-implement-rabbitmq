<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Bahan\Models\Bahan;
use Infra\SalesOrder\Model\Customer\Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bahan::class, 'bahan_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class, 'customer_id')->constrained()->cascadeOnDelete();
            $table->double('jumlah');
            $table->date('tanggal_kirim');
            $table->string('status')->default('Order');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
