<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'borrow_date',
        'due_date', 'return_date', 'status', 'fine',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date'    => 'date',
        'return_date' => 'date',
    ];

    // Relasi
    public function user() { return $this->belongsTo(User::class); }
    public function book() { return $this->belongsTo(Book::class); }

    // Hitung denda (Rp1.000/hari)
    public function calculateFine(): int
    {
        $returnDate = $this->return_date ?? Carbon::today();
        $daysLate = $this->due_date->diffInDays($returnDate, false);
        return $daysLate > 0 ? $daysLate * 1000 : 0;
    }

    // Cek apakah terlambat
    public function isLate(): bool
    {
        return Carbon::today()->gt($this->due_date) && $this->status === 'dipinjam';
    }
}
