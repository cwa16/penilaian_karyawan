<?php

namespace App\Imports;

use App\Models\KpiKualitatif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class KpiKualitatifImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        Log::info($row);

        if(empty($row['nik'])){
            return null;
        }

        return new KpiKualitatif([
            'no' => $row['no'],
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'status' => $row['status'],
            'dept' => $row['dept'],
            'posisi' => $row['posisi'],

            'kpi_dept_full_year' => $row['kpi_dept_full_year'],
            'kpi_dept_result' => $row['kpi_dept_result'],

            'kpi_individu_full_year' => $row['kpi_individu_full_year'],
            'kpi_individu_result' => $row['kpi_individu_result'],

            'total' => $row['total'],

            'assessment_kpi_60' => $row['assessment_kpi_60'],

            'assessment_atasan_40' => $row['assessment_atasan_40'],
            'assessment_atasan_result' => $row['assessment_atasan_result'],

            'total_assessment' => $row['total_assessment'],

            'percent_kehadiran' => $row['percent_kehadiran'],
            'pengurang_kehadiran' => $row['pengurang_kehadiran'],

            'percent_late' => $row['percent_late'],
            'pengurang_late' => $row['pengurang_late'],

            'st' => $row['st'],
            'sp1' => $row['sp1'],
            'sp2' => $row['sp2'],
            'sp3' => $row['sp3'],

            'pengurang_sp' => $row['pengurang_sp'],

            'assessment_final' => $row['assessment_final'],
            'grade' => $row['grade'],
        ]);
    }
    public function chunkSize(): int
    {
        return 100;
    }
}