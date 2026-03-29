<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBookedDate extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'book_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function room_number()
    {
        return $this->belongsTo(RoomNumber::class, 'room_number_id');
    }
}
