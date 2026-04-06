<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/CategorySeeder.php
    public function run(): void
    {
        $categories = ['Sains', 'Novel', 'Sejarah', 'Teknologi', 'Agama'];
        foreach ($categories as $c) {
            \App\Models\Category::create(['name' => $c]); // Sesuaikan nama kolom tabel kategori
        }
    }
}
