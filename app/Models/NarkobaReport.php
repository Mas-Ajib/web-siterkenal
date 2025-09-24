<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NarkobaReport extends Model
{
    use HasFactory;

    protected $table = 'narkoba_reports';

    protected $fillable = [
        'nama',
        'telepon',
        'tempat_kejadian',
        'keterangan'
    ];
}