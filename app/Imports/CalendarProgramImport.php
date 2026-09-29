<?php

namespace App\Imports;

use App\Models\CalendarProgram;
use App\Models\CalendarProgramMonth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModelConcerns;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class CalendarProgramImport implements ToModelConcerns, WithHeadingRow
{
    use Importable;

    protected $tahun;
    protected $errors = [];
    protected $imported = 0;

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    public function model(array $row)
    {
        // Skip header rows
        if (empty($row['penanggung_jawab']) || empty($row['uraian_kegiatan'])) {
            return null;
        }

        // Check if it's a header row
        if (strtolower($row['penanggung_jawab']) === 'penanggung jawab' ||
            strtolower($row['uraian_kegiatan']) === 'uraian kegiatan') {
            return null;
        }

        DB::beginTransaction();

        try {
            $program = CalendarProgram::create([
                'tahun' => $this->tahun,
                'penanggung_jawab' => $row['penanggung_jawab'],
                'uraian_kegiatan' => $row['uraian_kegiatan'],
                'anggaran' => is_numeric($row['anggaran'] ?? null) ? $row['anggaran'] : null,
                'status' => 'aktif',
            ]);

            // Read months from columns 1-12
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $colName = (string) $bulan;
                if (isset($row[$colName]) && $row[$colName] == 1) {
                    CalendarProgramMonth::create([
                        'calendar_program_id' => $program->id,
                        'bulan' => $bulan,
                    ]);
                }
            }

            DB::commit();
            $this->imported++;
            return $program;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errors[] = "Error: " . $e->getMessage();
            return null;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getImportedCount(): int
    {
        return $this->imported;
    }
}
