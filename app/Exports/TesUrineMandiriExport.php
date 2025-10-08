<?php
// app/Exports/TesUrineMandiriExport.php

namespace App\Exports;

use App\Models\TesUrineMandiri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TesUrineMandiriExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return TesUrineMandiri::all();
    }

    public function headings(): array
    {
        return [
            'Jenis Tes',
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

    public function map($tesUrine): array
    {
        return [
            $tesUrine->jenis_tes_text,
            $tesUrine->nama_penyelenggara,
            $tesUrine->tanggal->format('d/m/Y'),
            $tesUrine->waktu,
            $tesUrine->tempat,
            $tesUrine->nama_penanggung_jawab,
            $tesUrine->nohp_penanggung_jawab,
            $tesUrine->jumlah_peserta,
            $tesUrine->keterangan ?: 'Tidak ada',
            $tesUrine->created_at->format('d/m/Y H:i')
        ];
    }
}