<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
// --- TAMBAHKAN IMPORT DI BAWAH INI ---
use App\Models\Customer; 

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
        'nomor_karyawan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', 
        ];
    }

    public function customer(): HasOne
    {
        // Sekarang Customer::class akan terbaca karena sudah di-import di atas
        return $this->hasOne(Customer::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Pastikan ID panel di bawah ini sesuai dengan yang ada di Provider kamu
        // Biasanya secara default Filament hanya punya satu panel dengan ID 'admin'
        
        if ($panel->getId() === 'admin') {
            // Admin dan Staff mungkin sama-sama masuk ke panel 'admin'
            return in_array(strtolower($this->role), ['admin', 'staff']);
        }

        // Jika kamu memang punya dua panel berbeda (Panel Admin & Panel Staff)
        if ($panel->getId() === 'staff') {
            return strtolower($this->role) === 'staff';
        }

        return false;
    }
}