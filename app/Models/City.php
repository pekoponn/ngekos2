<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'image',
        'name',
        'slug'
    ];

    public function boardingHouses(): HasMany
    {
        return $this->hasMany(BoardingHouse::class);
    }
}