<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sosialisasi extends Model
{
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
        'lampiran',
    ];
}

