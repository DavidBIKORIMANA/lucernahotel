<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRateOverride extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function rateSeason()
    {
        return $this->belongsTo(RateSeason::class);
    }
}
