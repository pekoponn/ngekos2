<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'city_id',
        'category_id',
        'description',
        'price',
        'address',
        'phone_number',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where('name', 'like', '%'.$search.'%')
                  ->orWhere('description', 'like', '%'.$search.'%')
        );

        $query->when($filters['city'] ?? false, fn($query, $city) => 
            $query->whereHas('city', fn($query) => 
                $query->where('slug', $city)
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) => 
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category)
            )
        );
    }
}