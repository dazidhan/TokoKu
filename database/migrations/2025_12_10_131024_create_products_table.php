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
            $table->id();
            $table->string('sku')->unique()->nullable(); // Kode unik barang
            $table->string('name');
            $table->string('category'); // Makanan, Minuman, Kebersihan
            $table->integer('stock');
            $table->integer('min_stock')->default(10); // Trigger alert jika stok < ini
            $table->decimal('price', 12, 0);
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
