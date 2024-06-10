<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormExtra extends Model
{
   protected $fillable = ['form_id', 'key', 'value', 'label', 'int_id', ' pen_id'];
   protected $table = 'form_extra';

   public function getPenInfo()
   {
      return $this->belongsTo(Pen::class, 'pen_id', 'id');
   }

   public function getOrphanId()
   {
      return $this->belongsTo(Orphan::class, 'pen_id', 'pen_id');
   }
}
