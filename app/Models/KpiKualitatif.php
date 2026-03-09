<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiKualitatif extends Model
{
    protected $table = 'kpi_kualitatifs';

    protected $fillable = [
        'no',
        'tahun',
        'nik',
        'nama',
        'status',
        'dept',
        'jabatan',
        'posisi',

        'kpi_dept_full_year',
        'kpi_dept_result',

        'kpi_individu_full_year',
        'kpi_individu_result',

        'total',
        'assessment_kpi_60',

        'assessment_atasan_40',
        'assessment_atasan_result',

        'total_assessment',

        'percent_kehadiran',
        'pengurang_kehadiran',

        'percent_late',
        'pengurang_late',

        'st',
        'sp1',
        'sp2',
        'sp3',

        'pengurang_sp',

        'assessment_final',
        'grade'
    ];
}