@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow mt-6">
    <h1 class="text-2xl font-bold text-green-700 mb-6">📅 Registrar planificación</h1>

    <form action="{{ route('planificaciones.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Zona -->
        <div>
            <label class="block font-semibold text-gray-700">Zona</label>
            <select name="zona_id" class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500">
                @foreach ($zonas as $zona)
                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Frecuencia -->
        <div>
            <label class="block font-semibold text-gray-700">Frecuencia</label>
            <select name="frecuencia" class="w-full border-gray-300 rounded p-2">
                <option value="Diaria">Diaria</option>
                <option value="Semanal">Semanal</option>
                <option value="Mensual">Mensual</option>
            </select>
        </div>

        <!-- Horarios -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700">Hora inicio</label>
                <input type="time" name="hora_inicio" class="w-full border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block font-semibold text-gray-700">Hora fin</label>
                <input type="time" name="hora_fin" class="w-full border-gray-300 rounded p-2">
            </div>
        </div>

        <!-- Fechas -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700">Fecha inicio</label>
                <input type="date" name="fecha_inicio" class="w-full border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block font-semibold text-gray-700">Fecha fin</label>
                <input type="date" name="fecha_fin" class="w-full border-gray-300 rounded p-2">
            </div>
        </div>

        <!-- Observaciones -->
        <div>
            <label class="block font-semibold text-gray-700">Observaciones</label>
            <textarea name="observaciones" rows="3" class="w-full border-gray-300 rounded p-2"></textarea>
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('planificaciones.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Volver
            </a>
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Guardar planificación
            </button>
        </div>
    </form>
</div>
@endsection
