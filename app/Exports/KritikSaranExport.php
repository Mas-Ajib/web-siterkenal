<?php
// app/Exports/KritikSaranExport.php

namespace App\Exports;

use App\Models\KritikSaranReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KritikSaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return KritikSaranReport::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pengirim',
            'Telepon',
            'Kritik',
            'Saran',
            'Pengaduan Layanan',
            'Tanggal Dibuat'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->nama ?? 'Anonim',
            $report->telepon ?? '-',
            $report->kritik ?? '-',
            $report->saran ?? '-',
            $report->pengaduan_layanan ?? '-',
            $report->created_at->format('d/m/Y H:i')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 15,
            'D' => 40,
            'E' => 40,
            'F' => 40,
            'G' => 20,
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
            'A:G' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            
            // Border untuk seluruh tabel
            'A1:G' . ($sheet->getHighestRow()) => [
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