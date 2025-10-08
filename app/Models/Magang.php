<?php
// app/Models/Magang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magangs';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'instansi',
        'penanggung_jawab',
        'kontak',
        'jangka_waktu',
        'jumlah_peserta',
        'lampiran'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk cek apakah ada lampiran
    public function getAdaLampiranAttribute()
    {
        return !empty($this->lampiran);
    }

    // Accessor untuk tipe file lampiran
    public function getTipeLampiranAttribute()
    {
        if (!$this->lampiran) return null;
        
        $extension = pathinfo($this->lampiran, PATHINFO_EXTENSION);
        return strtolower($extension);
    }

    // Accessor untuk icon berdasarkan tipe file
    public function getIconLampiranAttribute()
    {
        if (!$this->lampiran) return 'fa-times';
        
        $extension = $this->tipe_lampiran;
        
        switch ($extension) {
            case 'pdf':
                return 'fa-file-pdf';
            case 'doc':
            case 'docx':
                return 'fa-file-word';
            case 'xls':
            case 'xlsx':
                return 'fa-file-excel';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'fa-file-image';
            default:
                return 'fa-file';
        }
    }

    // Accessor untuk warna berdasarkan tipe file
    public function getWarnaLampiranAttribute()
    {
        if (!$this->lampiran) return 'gray';
        
        $extension = $this->tipe_lampiran;
        
        switch ($extension) {
            case 'pdf':
                return 'red';
            case 'doc':
            case 'docx':
                return 'blue';
            case 'xls':
            case 'xlsx':
                return 'green';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'purple';
            default:
                return 'gray';
        }
    }
}