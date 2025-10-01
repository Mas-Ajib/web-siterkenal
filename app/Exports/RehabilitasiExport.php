<?php
// app/Exports/RehabilitasiExport.php

namespace App\Exports;

use App\Models\Rehabilitasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RehabilitasiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Rehabilitasi::all();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Alamat',
            'No HP',
            'Wali',
            'Riwayat',
            'Tanggal Daftar'
        ];
    }

    public function map($rehabilitasi): array
    {
        return [
            $rehabilitasi->nama,
            $rehabilitasi->alamat,
            $rehabilitasi->no_hp,
            $rehabilitasi->wali ?: 'Tidak ada',
            $rehabilitasi->riwayat ?: 'Tidak ada riwayat',
            $rehabilitasi->created_at->format('d/m/Y H:i')
        ];
    }
}