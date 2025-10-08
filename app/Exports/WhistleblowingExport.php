<?php
// app/Exports/WhistleblowingExport.php

namespace App\Exports;

use App\Models\WhistleBlowingReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WhistleblowingExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return WhistleBlowingReport::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenis Pelanggaran',
            'Jenis Pelanggaran Lainnya',
            'Nama Pelapor',
            'Lokasi Kejadian',
            'Kota/Kabupaten',
            'Provinsi',
            'Tanggal Kejadian',
            'Waktu Kejadian',
            'Uraian Pengaduan',
            'Email',
            'Tanggal Dibuat'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->jenis_pelanggaran,
            $report->jenis_pelanggaran_lainnya ?? '-',
            $report->nama_pelapor ?? 'Anonim',
            $report->lokasi_kejadian,
            $report->kota_kabupaten,
            $report->provinsi,
            $report->tanggal_kejadian->format('d/m/Y'),
            $report->waktu_kejadian ?? '-',
            $report->uraian_pengaduan,
            $report->email ?? '-',
            $report->created_at->format('d/m/Y H:i')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 25,
            'D' => 20,
            'E' => 25,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 40,
            'K' => 25,
            'L' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2D3748']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            
            // Style untuk data
            'A:L' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            
            // Border untuk seluruh tabel
            'A1:L' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB']
                    ]
                ]
            ]
        ];
    }
}