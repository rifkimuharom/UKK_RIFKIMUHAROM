<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Nasi Goreng Spesial',
                'harga_beli' => 12000,
                'harga_jual' => 18000,
                'stok' => 50,
                'satuan' => 'pcs',
                'minimum_stok' => 10,
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Mie Goreng Jawa',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
                'stok' => 60,
                'satuan' => 'pcs',
                'minimum_stok' => 10,
                'deskripsi' => 'Mie goreng khas Jawa dengan bumbu tradisional',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Ayam Geprek Sambal Matah',
                'harga_beli' => 15000,
                'harga_jual' => 22000,
                'stok' => 40,
                'satuan' => 'pcs',
                'minimum_stok' => 8,
                'deskripsi' => 'Ayam goreng crispy dengan sambal matah segar',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Sate Ayam Madura',
                'harga_beli' => 18000,
                'harga_jual' => 25000,
                'stok' => 35,
                'satuan' => 'pcs',
                'minimum_stok' => 8,
                'deskripsi' => 'Sate ayam khas Madura dengan bumbu kacang',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Bakso Urat Komplit',
                'harga_beli' => 14000,
                'harga_jual' => 20000,
                'stok' => 45,
                'satuan' => 'pcs',
                'minimum_stok' => 10,
                'deskripsi' => 'Bakso urat dengan mie, tahu, dan kuah kaldu',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Soto Ayam Lamongan',
                'harga_beli' => 13000,
                'harga_jual' => 19000,
                'stok' => 55,
                'satuan' => 'pcs',
                'minimum_stok' => 10,
                'deskripsi' => 'Soto ayam khas Lamongan dengan koya',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Gado-Gado Jakarta',
                'harga_beli' => 11000,
                'harga_jual' => 16000,
                'stok' => 30,
                'satuan' => 'pcs',
                'minimum_stok' => 8,
                'deskripsi' => 'Gado-gado lengkap dengan lontong dan kerupuk',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Rawon Daging Sapi',
                'harga_beli' => 20000,
                'harga_jual' => 28000,
                'stok' => 25,
                'satuan' => 'pcs',
                'minimum_stok' => 5,
                'deskripsi' => 'Rawon daging sapi hitam khas Jawa Timur',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Makanan',
                'foto' => null,
                'nama' => 'Nasi Uduk Komplit',
                'harga_beli' => 12000,
                'harga_jual' => 17000,
                'stok' => 50,
                'satuan' => 'pcs',
                'minimum_stok' => 10,
                'deskripsi' => 'Nasi uduk dengan ayam, telur, dan sambal',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category' => 'Minuman',
                'foto' => null,
                'nama' => 'Es Teh Manis',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
                'stok' => 100,
                'satuan' => 'pcs',
                'minimum_stok' => 20,
                'deskripsi' => 'Es teh manis segar',
                'status' => 1,
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}