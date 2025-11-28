<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\Zona;
use Illuminate\Http\Request;

class PlanificacionController extends Controller
{
    public function index()
    {
        $planificaciones = Planificacion::with('zona')->get();
        return view('planificaciones.index', compact('planificaciones'));
    }

    public function create()
    {
        $zonas = Zona::all();
        return view('planificaciones.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona_id' => 'required|exists:zonas,id',
            'frecuencia' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        Planificacion::create($request->all());

        return redirect()->route('planificaciones.index')
                         ->with('success', '✅ Planificación registrada correctamente');
    }
}
