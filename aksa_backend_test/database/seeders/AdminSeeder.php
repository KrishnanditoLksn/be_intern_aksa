<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => 'Joko',
            'username' => 'admin',
            'phone'    => '081234567890',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'), // Jangan lupa enkripsi password
        ]);
    }
}