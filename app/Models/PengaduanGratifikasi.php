<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanGratifikasi extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_gratifikasi';

    protected $fillable = [
        'nama', 'nik', 'tempat_lahir', 'tgl_lahir', 'jabatan',
        'instansi', 'unit_eselon', 'email', 'no_hp', 'no_rumah', 'no_kantor',
        'alamat_kantor', 'alamat_pengiriman', 'uraian', 'nilai', 'peristiwa', 'tempat_tgl',
        'nama_pemberi', 'pekerjaan_pemberi', 'hubungan_pemberi', 'kontak_pemberi',
        'alasan', 'kronologi', 'link_dokumen', 'catatan', 'kompensasi'
    ];
}
