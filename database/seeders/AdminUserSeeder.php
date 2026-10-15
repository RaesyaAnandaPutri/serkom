<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminsolusikoneksi@gmail.com'],
            [
                'name' => 'Admin Solusi Koneksi',
                'password' => 'admin123',
                'email_verified_at' => now(),
            ]
        );
    }
}
