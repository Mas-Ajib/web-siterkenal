<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'lampiran',
    ];
}
