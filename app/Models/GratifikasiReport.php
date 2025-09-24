<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GratifikasiReport extends Model
{
    use HasFactory;

    protected $table = 'gratifikasi_reports';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jabatan',
        'nama_instansi',
        'unit_kerja',
        'email',
        'no_seluler',
        'no_rumah',
        'no_kantor',
        'alamat_kantor',
        'alamat_pengiriman',
        'jenis_penerimaan',
        'nilai_nominal',
        'peristiwa_penerimaan',
        'tempat_penerimaan',
        'tanggal_penerimaan',
        'nama_pemberi',
        'pekerjaan_jabatan_pemberi',
        'hubungan_dengan_pemberi',
        'alamat_pemberi',
        'telepon_pemberi',
        'fax_pemberi',
        'email_pemberi',
        'alasan_pemberian',
        'kronologi_penerimaan',
        'link_dokumen',
        'catatan_tambahan',
        'bersedia_kompensasi',
        'dokumen_path'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_penerimaan' => 'date',
        'nilai_nominal' => 'decimal:2',
        'bersedia_kompensasi' => 'boolean'
    ];
}