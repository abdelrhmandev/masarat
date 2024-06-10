<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
   protected $fillable = ['pen_id', 'form_id', 'created_at', 'updated_at'];
   protected $table = 'orphans';


   /**
    * Get the user associated with the Orphan
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
   public function __construct()
   {
      $this->ORPHANS_SERVICE      = app('App\Admin\Services\OrphansService');
   }

   public function getOrphanExtra()
   {
      return $this->hasMany(OrphanExtra::class, 'form_id', 'form_id');
   }

   public function getOrphanPathCategory()
   {
      return $this->hasOne(OrphanPath::class, 'form_id', 'form_id')->where('path_id', $this->ORPHANS_SERVICE->getCurrentPathid());
   }

   public function getOrphanAgeEquivalentDegree()
   {

      return $this->hasOne(OrphanAgeEquivalentDegree::class, 'form_id', 'form_id');
   }

   public function answers()
   {
      return $this->hasMany(OrphanAnswer::class, 'form_id', 'form_id');
   }

   public function getOrphanPen()
   {
      return $this->belongsTo(OrphanPen::class, 'pen_id', 'pen_id');
   }
}
