<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhistleBlowingReport extends Model
{
    use HasFactory;

    protected $table = 'whistle_blowing_reports';

    protected $fillable = [
        'jenis_pelanggaran',
        'jenis_pelanggaran_lainnya',
        'nama_pelapor',
        'lokasi_kejadian',
        'kota_kabupaten',
        'provinsi',
        'tanggal_kejadian',
        'waktu_kejadian',
        'uraian_pengaduan',
        'email',
        'pernyataan'
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'pernyataan' => 'boolean'
    ];
}