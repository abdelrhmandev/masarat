<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrphanPen extends Model
{
    protected $fillable = ['pen_id','personal_id', 'name', 'mobile', 'confirmation_code','created_at'];
    protected $table = 'orphan_pens';
    public $timestamps = true;

    public function getOrphans(){
       return $this->hasMany(Orphan::class);
    }
}
        