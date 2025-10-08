<?php
// app/Models/TesUrineMandiri.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TesUrineMandiri extends Model
{
    use HasFactory;

    protected $table = 'tes_urine_mandiri';

    protected $fillable = [
        'jenis_tes',
        'nama_penyelenggara',
        'tanggal',
        'waktu',
        'tempat',
        'nama_penanggung_jawab',
        'nohp_penanggung_jawab',
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

    // Accessor untuk jenis tes
    public function getJenisTesTextAttribute()
    {
        $jenis = [
            'Masyarakat' => 'Masyarakat Umum',
            'Pemerintah' => 'Instansi Pemerintah',
            'Swasta' => 'Perusahaan Swasta',
            'Pendidikan' => 'Lembaga Pendidikan'
        ];

        return $jenis[$this->jenis_tes] ?? $this->jenis_tes;
    }

    // Scope untuk filter berdasarkan bulan - PASTIKAN METHOD INI ADA
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
    }

    // Scope untuk filter berdasarkan tahun - PASTIKAN METHOD INI ADA
    public function scopeTahunIni($query)
    {
        return $query->whereYear('tanggal', now()->year);
    }

    // Scope untuk filter berdasarkan jenis tes - PASTIKAN METHOD INI ADA
    public function scopeJenisTes($query, $jenis)
    {
        return $query->where('jenis_tes', $jenis);
    }
}