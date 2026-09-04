<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User khusus dengan Username & Email yang gampang
        User::factory()->create([
            'name'     => 'Admin Rifki',
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->count(5)->create();
    }
}
