<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Bahan\Models\Bahan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(Bahan::class, 'bahan_id');
            $table->dropColumn('jumlah');
            $table->string('code')->unique()->after('id');
            $table->string('name')->after('customer_id');
            $table->double('discount')->after('status')->default(0);
            $table->double('tax_cost')->after('discount')->default(0);
            $table->double('total_price')->after('discount')->default(0);
            $table->double('delivery_cost')->after('total_price')->default(0);
            $table->string('status_payment')->after('status')->default('unpaid');
            $table->string('shipper')->after('delivery_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->foreignIdFor(Bahan::class, 'bahan_id')->constrained()->cascadeOnDelete();
            $table->double('jumlah');
            $table->dropColumn('code');
            $table->dropColumn('tax_cost');
            $table->dropColumn('delivery_cost');
            $table->dropColumn('discount');
            $table->dropColumn('total_price');
            $table->dropColumn('status_payment');
            $table->dropColumn('name');
            $table->dropColumn('shipper');
        });
    }
};
