<?php
// app/Models/Sosialisasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sosialisasi extends Model
{
    use HasFactory;

    protected $table = 'sosialisasi';

    protected $fillable = [
        'jenis_sosialisasi',
        'nama_penyelenggara',
        'tanggal',
        'waktu',
        'tempat',
        'nama_penanggung_jawab',
        'no_hp_penanggung_jawab',
        'jumlah_peserta',
        'keterangan',
        'lampiran'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk tanggal format Indonesia
    public function getTanggalIndoAttribute()
    {
        return $this->tanggal->format('d/m/Y');
    }

    // Accessor untuk waktu format
    public function getWaktuFormatAttribute()
    {
        return date('H:i', strtotime($this->waktu));
    }

    // Accessor untuk keterangan pendek
    public function getKeteranganShortAttribute()
    {
        return $this->keterangan ? Str::limit($this->keterangan, 50) : 'Tidak ada keterangan';
    }

    // Scope untuk filter berdasarkan bulan
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month);
    }

    // Scope untuk filter berdasarkan tahun
    public function scopeTahunIni($query)
    {
        return $query->whereYear('tanggal', now()->year);
    }
}