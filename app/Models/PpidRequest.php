<?php
// app/Models/PpidRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpidRequest extends Model
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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Accessor untuk status dalam bahasa Indonesia
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Menunggu',
            'processed' => 'Diproses', 
            'completed' => 'Selesai',
            'rejected' => 'Ditolak'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    // Accessor untuk cara memperoleh
    public function getCaraMemperolehTextAttribute()
    {
        $cara = [
            'soft_copy' => 'Soft Copy',
            'hard_copy' => 'Hard Copy',
            'melihat' => 'Melihat Langsung'
        ];

        return $cara[$this->cara_memperoleh] ?? $this->cara_memperoleh;
    }

    // Accessor untuk cara mengirim
    public function getCaraMengirimTextAttribute()
    {
        $cara = [
            'email' => 'Email',
            'pos' => 'Pos',
            'ambil_langsung' => 'Ambil Langsung'
        ];

        return $cara[$this->cara_mengirim] ?? $this->cara_mengirim;
    }
}