<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';

    protected $fillable = [
        'vehiculo',
        'tipo_mantenimiento',
        'fecha',
        'kilometraje',
        'costo_aproximado',
        'responsable',
        'descripcion',
    ];
}
