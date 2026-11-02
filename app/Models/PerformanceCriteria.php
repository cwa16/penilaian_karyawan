<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceCriteria extends Model
{
    protected $table = 'performance_criteria';

    protected $fillable = [
        'code',
        'name',
        'description',
        'weight',
    ];

    public function scales()
    {
        return $this->hasMany(PerformanceScaleDescription::class, 'criteria_id');
    }
}
