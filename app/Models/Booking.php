<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_night' => 'decimal:0',
        'actual_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount' => 'integer',
        'total_price' => 'decimal:2',
        'cancelled_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'denied_at' => 'datetime',
    ];

    public function assign_rooms()
    {
        return $this->hasMany(BookingRoomList::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id', 'id');
    }

    public function booked_dates()
    {
        return $this->hasMany(RoomBookedDate::class, 'booking_id');
    }

    public function payment_transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function extras()
    {
        return $this->hasMany(BookingExtra::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 1);
    }

    public function scopeCancelled($query)
    {
        return $query->whereNotNull('cancelled_at');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 1);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->denied_at) return 'Denied';
        if ($this->cancelled_at) return 'Cancelled';
        return match ((int)$this->status) {
            0 => 'Pending',
            1 => 'Confirmed',
            2 => 'Checked In',
            3 => 'Checked Out',
            default => 'Unknown',
        };
    }

    public function getPaymentLabelAttribute()
    {
        return match ((int)$this->payment_status) {
            0 => 'Unpaid',
            1 => 'Paid',
            2 => 'Refunded',
            3 => 'Partial',
            default => 'Unknown',
        };
    }

    public function getPaymentMethodLabelAttribute()
    {
        return match ($this->payment_method) {
            'MTN_MOMO' => 'MTN Mobile Money',
            'AIRTEL_MOMO' => 'Airtel Money',
            'BANK_TRANSFER' => 'Bank Transfer',
            'CASH' => 'Cash Payment',
            'Stripe' => 'Credit Card (Stripe)',
            'COD' => 'Pay at Hotel',
            default => $this->payment_method ?? 'Not Selected',
        };
    }

    public function confirm($adminId = null)
    {
        $this->update([
            'status' => 1,
            'confirmed_at' => now(),
            'confirmed_by' => $adminId,
        ]);
    }

    public function deny($reason = null, $adminId = null)
    {
        $this->update([
            'denied_at' => now(),
            'denial_reason' => $reason,
            'status' => 5,
        ]);
        $this->booked_dates()->delete();
    }

    public function cancel($reason = null)
    {
        $this->update([
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
            'status' => 4,
        ]);
        $this->booked_dates()->delete();
    }

    public function checkIn()
    {
        $this->update(['checked_in_at' => now(), 'status' => 2]);
    }

    public function checkOut()
    {
        $this->update(['checked_out_at' => now(), 'status' => 3]);
    }
}
