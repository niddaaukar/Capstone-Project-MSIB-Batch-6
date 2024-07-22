<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMotorcycle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class, 'type_id', 'id');
    }
}
