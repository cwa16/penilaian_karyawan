<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceScore extends Model
{
    public function criteria(){
    return $this->belongsTo(PerformanceCriteria::class);
}

public function evaluator(){
    return $this->belongsTo(User::class,'evaluator_id');
}

}
