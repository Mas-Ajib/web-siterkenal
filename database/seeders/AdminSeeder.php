<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada (opsional)
        // Admin::truncate();

        // Buat superadmin jika belum ada
        if (!Admin::where('email', 'admin@ppid.go.id')->exists()) {
            Admin::create([
                'name' => 'Administrator',
                'email' => 'admin@ppid.go.id',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'is_active' => true,
            ]);

            $this->command->info('Super Admin default berhasil dibuat!');
            $this->command->info('Email: admin@ppid.go.id');
            $this->command->info('Password: password123');
        } else {
            $this->command->info('Super Admin default sudah ada.');
        }

        // Buat admin contoh jika belum ada
        if (!Admin::where('email', 'admin2@ppid.go.id')->exists()) {
            Admin::create([
                'name' => 'Admin Biasa',
                'email' => 'admin2@ppid.go.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
            ]);
            
            $this->command->info('Admin biasa contoh berhasil dibuat!');
        }

        // Buat superadmin kedua contoh
        if (!Admin::where('email', 'superadmin2@ppid.go.id')->exists()) {
            Admin::create([
                'name' => 'Super Admin 2',
                'email' => 'superadmin2@ppid.go.id',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'is_active' => true,
            ]);
            
            $this->command->info('Super Admin kedua contoh berhasil dibuat!');
        }
    }
}