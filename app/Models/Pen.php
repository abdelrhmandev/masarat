<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pen extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the Pens
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reactivated(): HasMany
    {
        return $this->hasMany(ReactivatedUrl::class);
    }
}
