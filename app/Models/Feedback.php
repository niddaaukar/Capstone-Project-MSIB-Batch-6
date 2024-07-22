<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'feedbacks';
    protected $fillable = [
        'avatar',
        'booking_code',
        'vehicle_type',
        'vehicle_id',
        'feedback',
        'rating',
        'user_id',
        'user_name'
    ];

    public function vehicle()
    {
        if ($this->vehicle_type == 'car') {
            return $this->belongsTo(Car::class, 'vehicle_id');
        } else {
            return $this->belongsTo(Motorcycle::class, 'vehicle_id');
        }
    }
}
