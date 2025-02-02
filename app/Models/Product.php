<?php

namespace App\Models;

use App\Models\Panier;
use App\Models\Favoris;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'nom',
        'description',
        'price',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];
    use HasFactory;


    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the paniers that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paniers(): BelongsTo
    {
        return $this->belongsTo(Panier::class);
    }

    /**
     * Get all of the favoris for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris(): HasMany
    {
        return $this->hasMany(Favoris::class);
    }

    public function isFavoris()
    {
        return $this->hasMany(Favoris::class);
    }
}
