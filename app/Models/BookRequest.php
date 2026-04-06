<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $table = 'requests'; // nama tabel manual

    protected $fillable = [
    'user_id', 'book_title', 'author',
    'reason', 'status', 'rejection_reason'
];

    public function user() { return $this->belongsTo(User::class); }
}
