<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceScore extends Model
{
    protected $table = 'performance_scores';
    protected $fillable = [
        'assessment_id',
        'criteria_id',
        'evaluator_nik',
        'score',
        'evaluator_order',
    ];

    public function criteria()
    {
        return $this->belongsTo(PerformanceCriteria::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_nik', 'nik');
    }

}
