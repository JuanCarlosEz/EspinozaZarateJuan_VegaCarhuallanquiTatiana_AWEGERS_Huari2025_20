<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
    use HasFactory;

    protected $table = 'planificaciones';

    protected $fillable = [
        'zona_id',
        'frecuencia',
        'hora_inicio',
        'hora_fin',
        'observaciones',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
