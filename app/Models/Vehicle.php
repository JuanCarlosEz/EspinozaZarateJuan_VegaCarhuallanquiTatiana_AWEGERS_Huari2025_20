<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['placa','modelo','driver_id','zona'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function positions()
    {
        return $this->hasMany(VehiclePosition::class);
    }
}
