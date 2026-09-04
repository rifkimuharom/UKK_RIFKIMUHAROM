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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // UBAH: dari category_id (foreignId) menjadi category (string)
            $table->string('category');

            // DIBUAT NULLABLE AGAR BISA DISIMPAN TANPA FOTO
            $table->string('foto')->nullable();

            $table->string('nama');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->string('satuan', 50)->default('pcs');
            $table->integer('minimum_stok')->nullable()->default(0);
            $table->text('deskripsi')->nullable();
            $table->boolean('status')->default(1);

            $table->index('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};