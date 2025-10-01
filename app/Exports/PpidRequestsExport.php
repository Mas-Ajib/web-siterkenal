<?php
// app/Exports/PpidRequestsExport.php

namespace App\Exports;

use App\Models\PpidRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PpidRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return PpidRequest::all();
    }

    public function headings(): array
    {
        return [
            'Nama Pemohon',
            'Alamat',
            'Nomor Handphone',
            'Email',
            'Informasi Dibutuhkan',
            'Alasan Meminta',
            'Cara Memperoleh',
            'Cara Mengirim',
            'Status',
            'Tanggal Permohonan'
        ];
    }

    public function map($request): array
    {
        return [
            $request->nama_pemohon,
            $request->alamat,
            $request->nomor_handphone,
            $request->email,
            $request->informasi_dibutuhkan,
            $request->alasan_meminta,
            $request->cara_memperoleh_text,
            $request->cara_mengirim_text,
            $request->status_text,
            $request->created_at->format('d/m/Y H:i')
        ];
    }
}