<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun untuk Panitia/Admin
        User::create([
            'name' => 'Admin Panitia',
            'email' => 'panitia@sekolah.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role' => 'panitia',
        ]);

        // (Opsional) Membuat contoh akun untuk Pengawas
        User::create([
            'name' => 'Pengawas Satu',
            'email' => 'pengawas1@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'pengawas',
        ]);
    }
}
