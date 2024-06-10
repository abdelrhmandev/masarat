<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['title','start_date','end_date','active'];
    protected $table = 'stages';
    public $timestamps = true;
    /**
     * Get the user associated with the Orphan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function answers()
    {
       return $this->hasMany(OrphanAnswer::class);
    }
}
        