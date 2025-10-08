<?php
// app/Exports/TatExport.php

namespace App\Exports;

use App\Models\Tat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TatExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Tat::all();
    }

    public function headings(): array
    {
        return [
            'Instansi Pemohon',
            'Nama Tersangka',
            'Tanggal Penangkapan',
            'Jenis Barang Bukti',
            'Berat Barang Bukti',
            'Hasil Urine',
            'Tanggal Input'
        ];
    }

    public function map($tat): array
    {
        return [
            $tat->instansi_pemohon,
            $tat->nama_tersangka,
            $tat->tanggal_penangkapan->format('d/m/Y'),
            $tat->jenis_barang_bukti,
            $tat->berat_barang_bukti,
            $tat->hasil_urine,
            $tat->created_at->format('d/m/Y H:i')
        ];
    }
}