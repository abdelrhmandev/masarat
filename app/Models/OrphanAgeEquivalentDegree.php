<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanAgeEquivalentDegree extends Model
{
    protected $fillable = ['value','form_id','stage_id'];
    protected $table = 'orphan_age_equivalent_degree';    
}
