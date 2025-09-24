<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDRequest extends Model
{
    use HasFactory;

    protected $table = 'ppid_requests';

    protected $fillable = [
        'nama_pemohon',
        'alamat',
        'nomor_handphone',
        'email',
        'informasi_dibutuhkan',
        'alasan_meminta',
        'cara_memperoleh',
        'cara_mengirim',
        'status'
    ];
}