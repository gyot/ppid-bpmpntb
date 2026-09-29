<?php

namespace App\Exports;

use App\Models\CalendarProgram;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CalendarProgramExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, ShouldAutoSize
{
    protected $tahun;
    protected $penanggungJawab;
    protected $rowNumber = 0;

    public function __construct(?int $tahun = null, ?string $penanggungJawab = null)
    {
        $this->tahun = $tahun;
        $this->penanggungJawab = $penanggungJawab;
    }

    public function collection()
    {
        $query = CalendarProgram::with('months')->active()->ordered();

        if ($this->tahun) {
            $query->byTahun($this->tahun);
        }

        if ($this->penanggungJawab) {
            $query->byPenanggungJawab($this->penanggungJawab);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Penanggung Jawab',
            'Uraian Kegiatan',
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',
            'Anggaran',
        ];
    }

    public function map($program): array
    {
        $this->rowNumber++;
        $bulanAktif = $program->months->pluck('bulan')->toArray();

        $row = [
            $program->penanggung_jawab,
            $program->uraian_kegiatan,
        ];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $row[] = in_array($bulan, $bulanAktif) ? 1 : '';
        }

        $row[] = $program->anggaran;

        return $row;
    }

    public function styles(Worksheet $sheet): array
    {
        // Title row
        $sheet->insertNewRowBefore(1);
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue('A1', 'DAFTAR PROGRAM BPMP PROVINSI NUSA TENGGARA BARAT');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Year row
        $sheet->insertNewRowBefore(2);
        $sheet->mergeCells('A2:O2');
        $sheet->setCellValue('A2', 'TAHUN ANGGARAN ' . ($this->tahun ?: date('Y')));
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Empty row
        $sheet->insertNewRowBefore(3);

        // Header style (row 4)
        return [
            4 => [
                'font' => ['bold' => true, 'size' => 10],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563EB'],
                ],
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::HORIZONTAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 40,
            'C' => 5,
            'D' => 5,
            'E' => 5,
            'F' => 5,
            'G' => 5,
            'H' => 5,
            'I' => 5,
            'J' => 5,
            'K' => 5,
            'L' => 5,
            'M' => 5,
            'N' => 5,
            'O' => 18,
        ];
    }
}
