<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // Kategori WAJIB dipanggil sebelum produk jika ada KategoriSeeder,
            // tapi jika tidak ada KategoriSeeder, ProdukSeeder di bawah sudah aman.
            ProdukSeeder::class,
            PenjualanSeeder::class,
        ]);

        // HAPUS / NONAKTIFKAN User::factory()->create() di sini
        // karena pemanggilan user sudah dihandle secara rapi oleh UserSeeder!
    }
}
