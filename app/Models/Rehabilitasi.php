<?php
// app/Models/Rehabilitasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // TAMBAHKAN INI

class Rehabilitasi extends Model
{
    use HasFactory;

    protected $table = 'rehabilitasi';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'wali',
        'riwayat'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk menampilkan nama wali jika ada
    public function getWaliDisplayAttribute()
    {
        return $this->wali ?: 'Tidak ada';
    }

    // Accessor untuk riwayat yang dipotong
    public function getRiwayatShortAttribute()
    {
        return $this->riwayat ? Str::limit($this->riwayat, 50) : 'Tidak ada riwayat';
    }
}