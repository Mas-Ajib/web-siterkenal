<?php
// app/Exports/PelaporanNarkobaExport.php

namespace App\Exports;

use App\Models\NarkobaReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PelaporanNarkobaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return NarkobaReport::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pelapor',
            'Telepon',
            'Tempat Kejadian',
            'Keterangan',
            'Tanggal Dibuat'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->nama ?? 'Anonim',
            $report->telepon ?? '-',
            $report->tempat_kejadian,
            $report->keterangan,
            $report->created_at->format('d/m/Y H:i')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 15,
            'D' => 30,
            'E' => 50,
            'F' => 20,
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
            'A:F' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            
            // Border untuk seluruh tabel
            'A1:F' . ($sheet->getHighestRow()) => [
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