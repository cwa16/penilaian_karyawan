<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceAssessment extends Model
{
    protected $table    = 'performance_assessments';
    protected $fillable = [
        'user_nik',
        'period_id',
        'status',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scores()
    {
        return $this->hasMany(PerformanceScore::class);
    }

}
