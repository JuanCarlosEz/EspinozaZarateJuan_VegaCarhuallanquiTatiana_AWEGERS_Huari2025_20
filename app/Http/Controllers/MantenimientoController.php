<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::latest()->get();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function create()
    {
        return view('mantenimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo' => 'required|string|max:255',
            'tipo_mantenimiento' => 'required|string|max:100',
            'fecha' => 'required|date',
            'kilometraje' => 'nullable|numeric',
            'costo_aproximado' => 'nullable|numeric',
            'responsable' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')
            ->with('success', '✅ Mantenimiento registrado correctamente');
    }
}
