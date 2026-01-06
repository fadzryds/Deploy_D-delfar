<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // ADMIN
        // ========================
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
                'nomor_karyawan' => 'ADM001',
            ]
        );

        // ========================
        // STAFF
        // ========================
        User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('staff1234'),
                'role' => 'staff',
                'nomor_karyawan' => 'STF001',
            ]
        );
    }
}
