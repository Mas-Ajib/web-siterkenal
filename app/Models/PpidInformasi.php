<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpidInformasi extends Model
{
    use HasFactory;

    protected $table = 'ppid_informasi';

    protected $fillable = [
        'nama_pemohon',
        'alamat',
        'no_hp',
        'email',
        'informasi_dibutuhkan',
        'alasan',
        'cara_memperoleh',
        'cara_mengirim',
    ];
}
