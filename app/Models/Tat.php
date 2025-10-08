<?php
// app/Models/Tat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tat extends Model
{
    use HasFactory;

    protected $table = 'tats';

    protected $fillable = [
        'instansi_pemohon',
        'nama_tersangka',
        'tanggal_penangkapan',
        'jenis_barang_bukti',
        'berat_barang_bukti',
        'hasil_urine',
        'surat_permohonan'
    ];

    protected $casts = [
        'tanggal_penangkapan' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk tanggal penangkapan format Indonesia
    public function getTanggalPenangkapanIndoAttribute()
    {
        return $this->tanggal_penangkapan->format('d/m/Y');
    }

    // Accessor untuk hasil urine dengan warna
    public function getHasilUrineColorAttribute()
    {
        return $this->hasil_urine == 'Positif' ? 'red' : 'green';
    }

    // Accessor untuk hasil urine dengan badge
    public function getHasilUrineBadgeAttribute()
    {
        if ($this->hasil_urine == 'Positif') {
            return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Positif</span>';
        } else {
            return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Negatif</span>';
        }
    }

    // Scope untuk filter hasil positif
    public function scopePositif($query)
    {
        return $query->where('hasil_urine', 'Positif');
    }

    // Scope untuk filter hasil negatif
    public function scopeNegatif($query)
    {
        return $query->where('hasil_urine', 'Negatif');
    }

    // Scope untuk filter berdasarkan bulan
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }
}