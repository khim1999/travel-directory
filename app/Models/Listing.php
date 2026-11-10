<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_verified' => 'boolean',
            'is_claimed' => 'boolean',
            'gallery' => 'array',
            'rating' => 'float',
            'price_avg' => 'float',
        ];
    }

    /**
     * Get the destination for this listing.
     *
     * @return BelongsTo<Destination, $this>
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the category for this listing.
     *
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get amenities for this listing.
     *
     * @return BelongsToMany<Amenity, $this>
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'listing_amenity');
    }

    /**
     * Get approved reviews for this listing.
     *
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_approved', true)->latest();
    }

    /**
     * Get claims submitted for this listing.
     *
     * @return HasMany<Claim, $this>
     */
    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

    /**
     * Get traveler leads captured for this listing.
     *
     * @return HasMany<Lead, $this>
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
