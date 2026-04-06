<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'author', 'publisher',
        'year_published', 'isbn', 'stock', 'cover', 'description',
    ];

    // Relasi
    public function category() { return $this->belongsTo(Category::class); }
    public function loans() { return $this->hasMany(Loan::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }

    // Cek stok tersedia
    public function isAvailable(): bool { return $this->stock > 0; }
}
