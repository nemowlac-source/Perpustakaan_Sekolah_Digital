<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

// app/Models/User.php

// Konstanta poin
const POINTS_RETURN_ONTIME  = 10;  // Kembalikan tepat waktu
const POINTS_BORROW_BOOK    = 2;   // Setiap meminjam buku
const POINTS_REQUEST_APPROVED = 5; // Request buku disetujui

public function addPoints(int $amount): void
{
    $this->increment('points', $amount);
}

public function deductPoints(int $amount): void
{
    $newPoints = max(0, $this->points - $amount);
    $this->update(['points' => $newPoints]);
}

// Hitung level berdasarkan poin
public function getLevel(): array
{
    return match(true) {
        $this->points >= 500 => ['name' => 'Platinum', 'color' => 'badge-primary',  'icon' => '💎'],
        $this->points >= 200 => ['name' => 'Gold',     'color' => 'badge-warning',  'icon' => '🥇'],
        $this->points >= 100 => ['name' => 'Silver',   'color' => 'badge-secondary','icon' => '🥈'],
        $this->points >= 50  => ['name' => 'Bronze',   'color' => 'badge-accent',   'icon' => '🥉'],
        default              => ['name' => 'Pemula',   'color' => 'badge-ghost',    'icon' => '📚'],
    };
}

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     protected $fillable = [
        'name', 'username', 'nis', 'email',
        'password', 'role', 'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     // Relasi
    public function loans() { return $this->hasMany(Loan::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }
    public function requests() { return $this->hasMany(BookRequest::class); }

    // Helper: cek role
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isSiswa(): bool { return $this->role === 'siswa'; }

    // Tambah poin saat buku dikembalikan tepat waktu

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
