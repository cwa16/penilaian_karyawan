<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiKualitatif extends Model
{
    protected $fillable = [
    'period_id',

    'nik',
    'nama',
    'status',
    'dept',
    'posisi',

    'kpi_dept_full_year',
    'kpi_dept_result',

    'kpi_individu_full_year',
    'kpi_individu_result',

    'total_kpi',

    'assessment_kpi',
    'assessment_kpi_result',

    'assessment_atasan',
    'assessment_atasan_result',

    'total_assessment',

    'kehadiran',
    'pengurang_kehadiran',

    'late',
    'pengurang_late',

    'st',
    'sp1',
    'sp2',
    'sp3',

    'pengurang_score',

    'assessment_final',
    'grade'
    ];   
}

