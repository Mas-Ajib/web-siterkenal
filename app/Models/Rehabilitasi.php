<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehabilitasi extends Model
{
    use HasFactory;

    protected $table = 'rehabilitasi';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'wali',
        'riwayat',
    ];
}
