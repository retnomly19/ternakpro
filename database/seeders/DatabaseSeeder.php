<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin1122@gmail.com',
        'password' => Hash::make('admin1122'), // kamu bisa ganti sesuai kebutuhan
        'role' => 'admin', // pastikan kolom 'role' sudah ada di tabel users
    ]);
}
}
