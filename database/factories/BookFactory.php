<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;


class BookFactory extends Factory
{
    public function definition(): array
    {
       return [
            // SINKRONISASI RELASI:
            // Mengambil ID kategori secara acak dari tabel categories
            'category_id'    => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title'          => fake()->sentence(3),
            'author'         => fake()->name(),
            'publisher'      => fake()->company(),
            'year_published' => fake()->year(),
            'isbn'           => fake()->unique()->isbn13(),
            'stock'          => fake()->numberBetween(1, 20),
            'cover'          => 'https://picsum.photos/seed/'.fake()->uuid.'/400/600',
            'description'    => fake()->paragraph(),
        ];
    }
}
