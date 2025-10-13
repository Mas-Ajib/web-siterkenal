<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing admins
        DB::table('admins')->truncate();

        // Create superadmin
        Admin::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@siterkenal.go.id',
            'password' => Hash::make('bnn.kendal4j4'),
            'role' => 'superadmin',
            'is_active' => true,
        ]);

        // Create regular admin
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@siterkenal.go.id',
            'password' => Hash::make('bersinar123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $this->command->info('Admin accounts created successfully!');
        $this->command->info('Super Admin: superadmin@siterkenal.go.id / bnn.kendal4j4');
        $this->command->info('Admin: admin@siterkenal.go.id / bersinar123');
    }
}