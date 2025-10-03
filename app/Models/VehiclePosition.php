<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclePosition extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id','lat','lng','recorded_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
