<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', // Tambahkan kolom phone
        'address', // Tambahkan kolom address
        'ktp', // Tambahkan kolom ktp untuk menyimpan path file KTP
        'sim', // Tambahkan kolom sim untuk menyimpan path file SIM
        'account_status',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the path to the KTP file.
     *
     * @return string
     */
    public function getKtpPathAttribute()
    {
        return $this->ktp ? asset('storage/' . $this->ktp) : null;
    }

    /**
     * Get the path to the SIM file.
     *
     * @return string
     */
    public function getSimPathAttribute()
    {
        return $this->sim ? asset('storage/' . $this->sim) : null;
    }

    /**
     * Check if the user has updated profile information.
     *
     * @return bool
     */
    public function hasUpdatedProfile()
    {
        return !is_null($this->phone) && !is_null($this->address) && !is_null($this->ktp) && !is_null($this->sim);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
