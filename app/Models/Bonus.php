<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{

    protected $fillable = [
        'boarding_house_id',
        'image',
        'name',
        'description', 
    ];

    public function boardingHouses()
    {
        return $this->belongsTo(BoardingHouses::class);
    }
}
