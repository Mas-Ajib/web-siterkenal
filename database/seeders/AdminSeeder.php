<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@ppid.go.id',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
        ]);

        $this->command->info('Admin default berhasil dibuat!');
        $this->command->info('Email: admin@ppid.go.id');
        $this->command->info('Password: password123');
    }
}