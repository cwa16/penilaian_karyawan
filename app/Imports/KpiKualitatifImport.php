<?php

namespace App\Imports;

use App\Models\KpiKualitatif;
use Maatwebsite\Excel\Concerns\ToModel;

class KpiKualitatifImport implements ToModel
{
    public function endColumn(): string
    {
        return 'AA';
    }

    private $periodId;

    public function __construct($periodId)
    {
        $this->periodId = $periodId;
    }

    public function startRow(): int
        {
            return 1;
        }

    // model() tetap di sini

    private function clean($value, $isPercent = false)
    {
    if ($value === null) {
        return null;
    }

        $value = trim($value);

        if (
            $value === '-' ||
            $value === '' ||
            $value === '#N/A' ||
            $value === '#REF!' ||
            $value === '#VALUE!' ||
            $value === '#DIV/0!' ||
            $value === '#ERROR!'
        ) {
            return null;
        }

        // hapus %
        $value = str_replace('%', '', $value);

        // ubah koma jadi titik
        $value = str_replace(',', '.', $value);

         // jika kolom persentase, ubah ke desimal 0-1
        if ($isPercent && is_numeric($value)) {
            $value = $value / 100;
        }

        return $value;
    }
        public function model(array $row)
        {
        // memastikan nilai numeric untuk assessment_final
    $assessmentFinal = $this->clean($row[25] ?? null);
    if (!is_numeric($assessmentFinal)) {
        $assessmentFinal = null; // atau 0 jika mau default 0
    }

    $assessmentKpiResult = $this->clean($row[12] ?? null);
    if (!is_numeric($assessmentKpiResult)) {
        $assessmentKpiResult = 0; // default 0
    }

    $assessmentAtasanResult = $this->clean($row[14] ?? null);
    if (!is_numeric($assessmentAtasanResult)) {
        $assessmentAtasanResult = 0;
    }

    // contoh untuk kolom lain yang numeric
    $totalAssessment = $this->clean($row[15] ?? null);
    if (!is_numeric($totalAssessment)) {
        $totalAssessment = 0;
    }

    return new KpiKualitatif([
        'period_id' => $this->periodId,

        'nik' => $row[1] ?? null,
        'nama' => $row[2] ?? null,
        'status' => $row[3] ?? null,
        'dept' => $row[4] ?? null,
        'posisi' => $row[5] ?? null,

        'kpi_dept_full_year' => $this->clean($row[6] ?? null),
        'kpi_dept_result' => $this->clean($row[7] ?? null),

        'kpi_individu_full_year' => $this->clean($row[8] ?? null),
        'kpi_individu_result' => $this->clean($row[9] ?? null),

        'total_kpi' => $this->clean($row[10] ?? null),

        'assessment_kpi' => $this->clean($row[11] ?? null),
        'assessment_kpi_result' => $this->clean($row[12] ?? null),

        'assessment_atasan' => $this->clean($row[13] ?? null),
        'assessment_atasan_result' => $this->clean($row[14] ?? null)
        ,
        'total_assessment' => $this->clean($row[15] ?? null),

        'kehadiran' => $this->clean($row[16] ?? null),
        'pengurang_kehadiran' => $this->clean($row[17] ?? null),

        'late' => $this->clean($row[18] ?? null),
        'pengurang_late' => $this->clean($row[19] ?? null),

        'st' => $this->clean($row[20] ?? null),
        'sp1' => $this->clean($row[21] ?? null),
        'sp2' => $this->clean($row[22] ?? null),
        'sp3' => $this->clean($row[23] ?? null),

        'pengurang_score' => $this->clean($row[24] ?? null),

        'assessment_final' => is_numeric($this->clean($row[25] ?? null))
            ? $this->clean($row[25])
            : null,
        'grade' => $row[26] ?? null,
        ]);
    }
}