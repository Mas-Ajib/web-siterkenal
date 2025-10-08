<?php
// app/Exports/MagangExport.php

namespace App\Exports;

use App\Models\Magang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MagangExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Magang::all();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'Instansi',
            'Penanggung Jawab',
            'Kontak',
            'Jangka Waktu',
            'Jumlah Peserta',
            'Lampiran',
            'Tanggal Input'
        ];
    }

    public function map($magang): array
    {
        return [
            $magang->nama_lengkap,
            $magang->email,
            $magang->instansi,
            $magang->penanggung_jawab,
            $magang->kontak,
            $magang->jangka_waktu . ' hari',
            $magang->jumlah_peserta,
            $magang->lampiran ? 'Ada' : 'Tidak Ada',
            $magang->created_at->format('d/m/Y H:i')
        ];
    }
}