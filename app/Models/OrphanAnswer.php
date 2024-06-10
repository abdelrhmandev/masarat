<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanAnswer extends Model
{
    protected $fillable = ['objective_id', 'form_id', 'notes', 'completed_case', 'stage_id', 'created_at'];
    protected $table = 'orphan_answers';

    public function getObjective()
    {
        return $this->belongsTo(Objective::class, 'objective_id', 'id');
    }
}
