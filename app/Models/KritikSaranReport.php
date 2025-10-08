<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaranReport extends Model
{
    use HasFactory;

    protected $table = 'kritik_saran_reports';

    protected $fillable = [
        'nama',
        'telepon',
        'kritik',
        'saran',
        'pengaduan_layanan'
    ];

    // Accessor untuk status anonim
    public function getStatusAnonimAttribute()
    {
        return is_null($this->nama) ? 'Anonim' : 'Teridentifikasi';
    }

    // Accessor untuk format tanggal
    public function getTanggalDibuatFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    // Accessor untuk tipe masukan
    public function getTipeMasukanAttribute()
    {
        $types = [];
        if (!empty($this->kritik)) $types[] = 'Kritik';
        if (!empty($this->saran)) $types[] = 'Saran';
        if (!empty($this->pengaduan_layanan)) $types[] = 'Pengaduan';
        
        return implode(', ', $types) ?: 'Tidak ada';
    }

    // Scope untuk laporan anonim
    public function scopeAnonim($query)
    {
        return $query->whereNull('nama');
    }

    // Scope untuk laporan teridentifikasi
    public function scopeTeridentifikasi($query)
    {
        return $query->whereNotNull('nama');
    }

    // Scope untuk memiliki kritik
    public function scopeMemilikiKritik($query)
    {
        return $query->whereNotNull('kritik')->where('kritik', '!=', '');
    }

    // Scope untuk memiliki saran
    public function scopeMemilikiSaran($query)
    {
        return $query->whereNotNull('saran')->where('saran', '!=', '');
    }

    // Scope untuk memiliki pengaduan
    public function scopeMemilikiPengaduan($query)
    {
        return $query->whereNotNull('pengaduan_layanan')->where('pengaduan_layanan', '!=', '');
    }

    // Scope untuk bulan ini
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    // Scope untuk tahun ini
    public function scopeTahunIni($query)
    {
        return $query->whereYear('created_at', now()->year);
    }
}