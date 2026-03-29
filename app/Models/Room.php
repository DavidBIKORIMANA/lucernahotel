<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'integer',
        'status' => 'integer',
        'featured' => 'boolean',
        'amenities' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'roomtype_id', 'id');
    }

    public function room_numbers()
    {
        return $this->hasMany(RoomNumber::class, 'rooms_id')->where('status', 'Active');
    }

    public function all_room_numbers()
    {
        return $this->hasMany(RoomNumber::class, 'rooms_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'rooms_id');
    }

    public function multi_images()
    {
        return $this->hasMany(MultiImage::class, 'rooms_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'rooms_id');
    }

    public function booked_dates()
    {
        return $this->hasMany(RoomBookedDate::class, 'room_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approved_reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function rate_overrides()
    {
        return $this->hasMany(RoomRateOverride::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->where('status', 1);
    }

    public function getEffectivePrice($date = null)
    {
        if ($date) {
            $override = $this->rate_overrides()
                ->whereHas('rateSeason', function ($q) use ($date) {
                    $q->where('start_date', '<=', $date)
                      ->where('end_date', '>=', $date)
                      ->where('is_active', true);
                })->first();

            if ($override) return $override->price;

            $season = RateSeason::where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->where('is_active', true)->first();

            if ($season) return round($this->price * $season->price_multiplier, 2);
        }

        return $this->price;
    }

    public function getDiscountedPrice($date = null)
    {
        $price = $this->getEffectivePrice($date);
        if ($this->discount > 0) {
            return round($price - ($price * $this->discount / 100), 2);
        }
        return $price;
    }

    public function getAverageRatingAttribute()
    {
        return $this->approved_reviews()->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute()
    {
        return $this->approved_reviews()->count();
    }
}
