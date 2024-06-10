<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrphanExtra extends Model
{
    protected $fillable = ['key','value','pen_id','form_id'];
    protected $table = 'orphan_extra';
}
