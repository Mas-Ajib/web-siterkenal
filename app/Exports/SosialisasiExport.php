<?php
// app/Exports/SosialisasiExport.php

namespace App\Exports;

use App\Models\Sosialisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SosialisasiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Sosialisasi::all();
    }

    public function headings(): array
    {
        return [
            'Jenis Sosialisasi',
            'Nama Penyelenggara',
            'Tanggal',
            'Waktu',
            'Tempat',
            'Penanggung Jawab',
            'No HP Penanggung Jawab',
            'Jumlah Peserta',
            'Keterangan',
            'Tanggal Input'
        ];
    }

    public function map($sosialisasi): array
    {
        return [
            $sosialisasi->jenis_sosialisasi,
            $sosialisasi->nama_penyelenggara,
            $sosialisasi->tanggal->format('d/m/Y'),
            $sosialisasi->waktu,
            $sosialisasi->tempat,
            $sosialisasi->nama_penanggung_jawab,
            $sosialisasi->no_hp_penanggung_jawab,
            $sosialisasi->jumlah_peserta,
            $sosialisasi->keterangan ?: 'Tidak ada',
            $sosialisasi->created_at->format('d/m/Y H:i')
        ];
    }
}