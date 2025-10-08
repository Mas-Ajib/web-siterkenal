<?php
// app/Exports/GratifikasiExport.php

namespace App\Exports;

use App\Models\GratifikasiReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GratifikasiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return GratifikasiReport::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jabatan',
            'Nama Instansi',
            'Unit Kerja',
            'Email',
            'No Seluler',
            'No Rumah',
            'No Kantor',
            'Alamat Kantor',
            'Alamat Pengiriman',
            'Jenis Penerimaan',
            'Nilai Nominal (Rp)',
            'Peristiwa Penerimaan',
            'Tempat Penerimaan',
            'Tanggal Penerimaan',
            'Nama Pemberi',
            'Pekerjaan/Jabatan Pemberi',
            'Hubungan dengan Pemberi',
            'Alamat Pemberi',
            'Telepon Pemberi',
            'Email Pemberi',
            'Alasan Pemberian',
            'Kronologi Penerimaan',
            'Bersedia Kompensasi',
            'Link Dokumen',
            'Catatan Tambahan',
            'Tanggal Dibuat'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->nama_lengkap,
            $report->nik,
            $report->tempat_lahir,
            $report->tanggal_lahir->format('d/m/Y'),
            $report->jabatan,
            $report->nama_instansi,
            $report->unit_kerja,
            $report->email,
            $report->no_seluler,
            $report->no_rumah ?? '-',
            $report->no_kantor ?? '-',
            $report->alamat_kantor,
            $report->alamat_pengiriman,
            $report->jenis_penerimaan,
            number_format($report->nilai_nominal, 0, ',', '.'),
            $report->peristiwa_penerimaan,
            $report->tempat_penerimaan,
            $report->tanggal_penerimaan->format('d/m/Y'),
            $report->nama_pemberi,
            $report->pekerjaan_jabatan_pemberi,
            $report->hubungan_dengan_pemberi,
            $report->alamat_pemberi,
            $report->telepon_pemberi ?? '-',
            $report->email_pemberi ?? '-',
            $report->alasan_pemberian,
            $report->kronologi_penerimaan,
            $report->bersedia_kompensasi ? 'Ya' : 'Tidak',
            $report->link_dokumen ?? '-',
            $report->catatan_tambahan ?? '-',
            $report->created_at->format('d/m/Y H:i')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 20,
            'D' => 15,
            'E' => 15,
            'F' => 20,
            'G' => 20,
            'H' => 15,
            'I' => 25,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 30,
            'N' => 30,
            'O' => 25,
            'P' => 20,
            'Q' => 30,
            'R' => 20,
            'S' => 15,
            'T' => 25,
            'U' => 25,
            'V' => 20,
            'W' => 30,
            'X' => 15,
            'Y' => 25,
            'Z' => 30,
            'AA' => 30,
            'AB' => 20,
            'AC' => 25,
            'AD' => 25,
            'AE' => 20,
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
            'A:AE' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            
            // Style untuk kolom nilai nominal (rata kanan)
            'P' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                ]
            ],
            
            // Border untuk seluruh tabel
            'A1:AE' . ($sheet->getHighestRow()) => [
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