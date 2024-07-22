<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'vehicle_name',
        'reason',
        'refund_account',
        'proof_payment',
        'refund_proof',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_code', 'booking_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
