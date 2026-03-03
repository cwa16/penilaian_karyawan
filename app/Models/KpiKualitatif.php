<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiKualitatif extends Model
{
    protected $fillable = [
        'tahun',
        'nik',
        'nama',
        'kategori',
        'nilai'
    ];
}