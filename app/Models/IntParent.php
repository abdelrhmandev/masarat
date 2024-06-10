<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntParent extends Model
{
    protected $fillable = ['name_en','name_ar'];
    protected $table = 'int_parent';

    public function Getchildints(): HasMany{
        return $this->hasMany(Ints::class);
    }
}
