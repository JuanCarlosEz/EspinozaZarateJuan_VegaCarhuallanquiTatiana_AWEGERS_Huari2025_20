<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable 
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'dni',
        'telefono',
        'email',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }
}
