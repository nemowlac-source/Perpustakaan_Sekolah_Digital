<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/AdminSeeder.php
public function run(): void
{
    \App\Models\User::create([
        'name'     => 'Administrator',
        'username' => 'admin',
        'email'    => 'admin@perpustakaan.com',
        'password' => bcrypt('admin123'),
        'role'     => 'admin',
    ]);
}
}
