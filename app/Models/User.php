<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Customer;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'foto', 'nomor_karyawan',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $allowedRoles = ['admin', 'staff', 'user']; 
        
        return in_array(strtolower($this->role), $allowedRoles);
    }
}