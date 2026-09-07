<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hargaBeli = $this->faker->numberBetween(10_000, 500_000);

        // Cari ID user yang ada, atau ambil ID pertama dari tabel users
        $userId = User::inRandomOrder()->value('id') ?? 1;

        // Cari ID kategori yang ada, atau buat dummy aman jika kosong
        $categoryId = Category::inRandomOrder()->value('id') ?? Category::firstOrCreate(
            ['nama' => 'Umum'],
            ['status' => 1]
        )->id;

        return [
            'user_id' => $userId,
            'category' => $categoryId,
            'foto' => 'produk/' . $this->faker->uuid . '.jpg',
            'nama' => $this->faker->words(3, true),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaBeli + $this->faker->numberBetween(5_000, 100_000),
            'stok' => $this->faker->numberBetween(1, 500),
            'satuan' => 'pcs',
            'minimum_stok' => 10,
            'deskripsi' => $this->faker->sentence(),
            'status' => 1,
        ];
    }
}
