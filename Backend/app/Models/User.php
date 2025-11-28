<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

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
        'role', // asegúrate de tener este campo en $fillable
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * Sincroniza automáticamente el campo "role" con Spatie.
     */
    protected static function booted()
    {
        static::retrieved(function ($user) {
            if ($user->role && !$user->hasRole($user->role)) {
                $user->syncRoles([$user->role]);
            }
        });
    }
}
