<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function last_booking()
    {
        return $this->hasOne(BookingRoomList::class, 'room_number_id')->latest();
    }

    public function booking_assignments()
    {
        return $this->hasMany(BookingRoomList::class, 'room_number_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
