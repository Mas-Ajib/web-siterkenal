<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skhpn extends Model
{
    use HasFactory;

    // kasih tahu tabelnya manual
    protected $table = 'skhpn';

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_hp',
        'tujuan',
    ];
}
