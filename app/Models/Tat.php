<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tat extends Model
{
    use HasFactory;

    protected $fillable = [
        'instansi_pemohon',
        'nama_tersangka',
        'tanggal_penangkapan',
        'jenis_barang_bukti',
        'berat_barang_bukti',
        'hasil_urine',
        'surat_permohonan',
    ];
}
