<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'vehicle_type',
        'vehicle_id',
        'user_id',
        'start_date',
        'end_date',
        'days_count',
        'booking_fee',
        'with_driver',
        'pickup',
        'driver_fee',
        'total_fee',
        'booking_status',
        'booking_code',
    ];

    public function vehicle()
    {
        if ($this->vehicle_type == 'car') {
            return $this->belongsTo(Car::class, 'vehicle_id');
        } else {
            return $this->belongsTo(Motorcycle::class, 'vehicle_id');
        }
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function moto()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function cancellation()
    {
        return $this->hasOne(Cancellation::class, 'booking_code', 'booking_code');
    }
}
