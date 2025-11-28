@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-6">
    <h1 class="text-2xl font-bold text-green-700 mb-6">➕ Crear nueva zona</h1>

    <form action="{{ route('zonas.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Nombre -->
        <div>
            <label class="block font-semibold text-gray-700">Nombre de la zona</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" 
                class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500">
            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Prioritaria -->
        <div class="flex items-center">
            <input type="checkbox" name="prioritaria" id="prioritaria" value="1"
                class="h-4 w-4 text-green-600 border-gray-300 rounded"
                {{ old('prioritaria') ? 'checked' : '' }}>
            <label for="prioritaria" class="ml-2 text-gray-700 font-medium">
                ¿Zona prioritaria?
            </label>
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('zonas.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Volver
            </a>
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Guardar zona
            </button>
        </div>
    </form>
</div>
@endsection
