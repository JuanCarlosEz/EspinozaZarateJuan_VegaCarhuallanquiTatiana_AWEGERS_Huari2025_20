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
        $reportes = Reporte::getAllSP();
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
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('reportes', 'public');
        }

        Reporte::insertSP([
            'tipo_incidencia' => $validated['tipo_incidencia'],
            'descripcion' => $validated['descripcion'] ?? null,
            'nivel_prioridad' => $validated['nivel_prioridad'],
            'zona_id' => $validated['zona_id'] ?? null,
            'referencia' => $validated['referencia'] ?? null,
            'foto' => $fotoPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('reportes.index')->with('success', 'Reporte registrado correctamente.');
    }

    public function show($id)
    {
        $reporte = Reporte::getByIdSP($id);

        if (empty($reporte)) {
            abort(404);
        }

        return view('reportes.show', ['reporte' => $reporte[0]]);
    }

    public function destroy($id)
    {
        $reporte = Reporte::getByIdSP($id);

        if (!empty($reporte)) {
            $foto = $reporte[0]->foto;
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        Reporte::deleteSP($id);

        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado correctamente.');
    }
}
