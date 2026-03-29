<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_response' => 'array',
        'verified_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function getMethodLabelAttribute()
    {
        return match ($this->method) {
            'MTN_MOMO' => 'MTN MoMo',
            'AIRTEL_MOMO' => 'Airtel Money',
            'BANK_TRANSFER' => 'Bank Transfer',
            'CASH' => 'Cash',
            'Stripe' => 'Stripe',
            'COD' => 'Pay at Hotel',
            default => $this->method,
        };
    }

    public function verify($adminId)
    {
        $this->update([
            'status' => 'success',
            'verified_by' => $adminId,
            'verified_at' => now(),
        ]);
    }
}
