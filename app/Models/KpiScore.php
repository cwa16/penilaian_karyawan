<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiScore extends Model
{
    protected $fillable = [
        'tahun',
        'nik',
        'nama',
        'dept',
        'jabatan',
        'posisi',
        'total_kpi',
    ];
}