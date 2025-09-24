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
}