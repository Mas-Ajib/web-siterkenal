<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string' // Tetap string, atau bisa diubah ke enum jika mau
    ];

    // Scope untuk superadmin
    public function scopeSuperadmin($query)
    {
        return $query->where('role', 'superadmin');
    }

    // Scope untuk admin biasa
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    // Check jika superadmin
    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }

    // Check jika admin biasa
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Accessor untuk role text
    public function getRoleTextAttribute()
    {
        return $this->role === 'superadmin' ? 'Super Admin' : 'Admin Biasa';
    }
}