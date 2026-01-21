<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceAssessment extends Model
{
    public function user(){
    return $this->belongsTo(User::class);
}

public function scores(){
    return $this->hasMany(PerformanceScore::class);
}

}
