<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceScaleDescription extends Model
{
    protected $table = 'performance_scale_descriptions';

    protected $fillable = [
        'criteria_id',
        'score',
        'description'
    ];

    public function criteria()
    {
        return $this->belongsTo(PerformanceCriteria::class, 'criteria_id');
    }
}