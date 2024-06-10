<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactivatedUrl extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the Pens
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pens(): HasMany
    {
        return $this->hasMany(Pen::class);
    }

}
