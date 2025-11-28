<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zona_id',
        'tipo_incidencia',
        'descripcion',
        'nivel_prioridad',
        'referencia',
        'foto',
        'ubicacion',
        'estado',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // ============================
    //   MÉTODOS STORE PROCEDURES
    // ============================

    public static function getAllSP()
    {
        return DB::select("CALL sp_read_reporte()");
    }

    public static function getByIdSP($id)
    {
        return DB::select("CALL sp_read_reporte_por_id(?)", [$id]);
    }

    public static function insertSP($data)
    {
        return DB::statement("CALL sp_insert_reporte(?, ?, ?, ?, ?, ?, ?)", [
            $data['tipo_incidencia'],
            $data['descripcion'],
            $data['nivel_prioridad'],
            $data['zona_id'],
            $data['referencia'],
            $data['foto'],
            $data['user_id']
        ]);
    }

    public static function updateSP($id, $data)
    {
        return DB::statement("CALL sp_update_reporte(?, ?, ?, ?, ?, ?, ?, ?)", [
            $id,
            $data['tipo_incidencia'],
            $data['descripcion'],
            $data['nivel_prioridad'],
            $data['zona_id'],
            $data['referencia'],
            $data['foto'],
            $data['estado'],
        ]);
    }

    public static function deleteSP($id)
    {
        return DB::statement("CALL sp_delete_reporte(?)", [$id]);
    }
}
