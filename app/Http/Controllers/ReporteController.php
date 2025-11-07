<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with('zona')->latest()->get();
        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        $zonas = Zona::all();
        return view('reportes.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_incidencia' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'nivel_prioridad' => 'required|string',
            'zona_id' => 'nullable|exists:zonas,id',
            'referencia' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'ubicacion' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('reportes', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['estado'] = 'pendiente';

        Reporte::create($validated);

        return redirect()->route('reportes.index')->with('success', 'Reporte registrado correctamente.');
    }

    public function show(Reporte $reporte)
    {
        return view('reportes.show', compact('reporte'));
    }

    public function destroy(Reporte $reporte)
    {
        if ($reporte->foto) {
            Storage::disk('public')->delete($reporte->foto);
        }
        $reporte->delete();

        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado correctamente.');
    }
}
