<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'roomtype_id');
    }

    // Keep legacy relation for backward compatibility
    public function room()
    {
        return $this->hasOne(Room::class, 'roomtype_id');
    }

    public function room_numbers()
    {
        return $this->hasMany(RoomNumber::class, 'room_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
