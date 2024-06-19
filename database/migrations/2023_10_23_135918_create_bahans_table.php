<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Infra\Bahan\Models\Category\Category;
use Infra\Bahan\Models\Satuan\Satuan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class, 'category_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Satuan::class, 'satuan_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('name');
            $table->double('stok')->default(0);
            $table->boolean('is_count')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahans');
    }
};
