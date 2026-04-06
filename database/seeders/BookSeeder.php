<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category; // Pastikan import model Category
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Jalankan factory untuk data random (pastikan factory sudah diperbaiki ke category_id)
        Book::factory()->count(50)->create();

        // 2. Perbaikan Input Manual (Laskar Pelangi)
        // Kita cari dulu ID kategori "Novel" dari database
        $category = Category::where('name', 'Novel')->first();

        Book::create([
            'category_id'    => $category->id ?? 1, // Gunakan ID, bukan nama string
            'title'          => 'Laskar Pelangi',
            'author'         => 'Andrea Hirata',
            'publisher'      => 'Bentang Pustaka',
            'year_published' => 2005,
            'isbn'           => '9789793062791',
            'stock'          => 5,
            'description'    => 'Kisah perjuangan 10 anak Belitung.',
            // Hapus baris 'category' => 'Novel' karena kolom itu tidak ada di tabel books
        ]);
    }
}
