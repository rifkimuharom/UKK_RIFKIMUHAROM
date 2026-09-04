<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Kolom Informasi Toko
            $table->string('nama_toko')->nullable()->default('KUDE POS');
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('logo')->nullable(); // Menyimpan path file gambar logo

            // Kolom Pengaturan Struk & Printer
            $table->string('ukuran_kertas')->default('58mm'); // 58mm atau 80mm
            $table->boolean('auto_print')->default(true);
            $table->string('footer_struk')->nullable();

            // Kolom Pajak / PPN
            $table->decimal('ppn', 5, 2)->default(0); // Contoh: 11.00

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};