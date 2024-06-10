<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrphanPath extends Model
{
   protected $fillable = ['form_id', 'path_id', 'stage_id', 'path_category'];
   protected $table = 'orphan_pathes';

   public function getOrphan()
   {
      return $this->belongsToMany(Orphans::class, 'form_id', 'form_id');
   }

   public function getObjectives()
   {
      return $this->belongsTo(Objective::class, 'path_id', 'id')->where('active', 1);
   }

   public function getPathCategory()
   {
      return $this->belongsTo(Path::class, 'path_id', 'id');
   }
}
