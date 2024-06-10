<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = ['tite', 'path_id', 'form_id', 'active'];
    protected $table = 'objectives';

    /**
     * Get the user associated with the Orphan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function __construct()
    {
        $this->ORPHANS_SERVICE      = app('App\Admin\Services\OrphansService');
    }

    public function path()
    {
        return $this->belongsTo(Path::class);
    }

    public function getOrphanRelatedObjectvies()
    {
        return $this->belongsTo(Objective::class, 'form_id', 'form_id');
    }

    public function getOrphanObjectiveAnswers()
    {
        return $this->hasOne(OrphanAnswer::class, 'objective_id', 'id')->where('stage_id', $this->ORPHANS_SERVICE->getCurrentStage()->first()->id);
    }

    public function getOrphanExtra()
    {
        return $this->hasOne(OrphanExtra::class, 'form_id', 'form_id');
    }
}
