<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Rifki',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123', // jangan bcrypt() lagi
        ]);

        User::factory()->count(5)->create();
    }
}