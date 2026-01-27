<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformancePeriod extends Model
{
    protected $table = 'performance_periods';

    protected $fillable = [
        'year',
        'name',
        'start_date',
        'end_date',
    ];
}
