@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow mt-6">
    <h1 class="text-2xl font-bold text-green-700 mb-6">🧰 Registrar mantenimiento</h1>

    <form action="{{ route('mantenimientos.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Vehículo -->
        <div>
            <label class="block font-semibold text-gray-700">Vehículo</label>
            <input type="text" name="vehiculo" value="{{ old('vehiculo') }}"
                   class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500">
            @error('vehiculo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipo -->
        <div>
            <label class="block font-semibold text-gray-700">Tipo de mantenimiento</label>
            <select name="tipo_mantenimiento"
                    class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500">
                <option value="Preventivo">Preventivo</option>
                <option value="Correctivo">Correctivo</option>
            </select>
        </div>

        <!-- Fecha y Kilometraje -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}"
                       class="w-full border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block font-semibold text-gray-700">Kilometraje</label>
                <input type="number" name="kilometraje" value="{{ old('kilometraje') }}"
                       class="w-full border-gray-300 rounded p-2">
            </div>
        </div>

        <!-- Costo -->
        <div>
            <label class="block font-semibold text-gray-700">Costo aproximado (S/)</label>
            <input type="number" step="0.01" name="costo_aproximado" value="{{ old('costo_aproximado') }}"
                   class="w-full border-gray-300 rounded p-2">
        </div>

        <!-- Responsable -->
        <div>
            <label class="block font-semibold text-gray-700">Responsable</label>
            <input type="text" name="responsable" value="{{ old('responsable') }}"
                   class="w-full border-gray-300 rounded p-2">
        </div>

        <!-- Descripción -->
        <div>
            <label class="block font-semibold text-gray-700">Observaciones</label>
            <textarea name="descripcion" rows="3"
                      class="w-full border-gray-300 rounded p-2">{{ old('descripcion') }}</textarea>
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('mantenimientos.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Volver
            </a>
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Guardar mantenimiento
            </button>
        </div>
    </form>
</div>
@endsection
