<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    public function index()
    {
        $zonas = Zona::all();
        return view('zonas.index', compact('zonas'));
    }

    public function create()
    {
        return view('zonas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'prioritaria' => 'nullable|boolean',
        ]);

        Zona::create([
            'nombre' => $validated['nombre'],
            'prioritaria' => $request->has('prioritaria'),
        ]);

        return redirect()->route('zonas.index')->with('success', 'Zona registrada correctamente.');
    }

    public function edit(Zona $zona)
    {
        return view('zonas.edit', compact('zona'));
    }

    public function update(Request $request, Zona $zona)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'prioritaria' => 'nullable|boolean',
        ]);

        $zona->update([
            'nombre' => $validated['nombre'],
            'prioritaria' => $request->has('prioritaria'),
        ]);

        return redirect()->route('zonas.index')->with('success', 'Zona actualizada correctamente.');
    }

    public function destroy(Zona $zona)
    {
        $zona->delete();
        return redirect()->route('zonas.index')->with('success', 'Zona eliminada correctamente.');
    }
}
