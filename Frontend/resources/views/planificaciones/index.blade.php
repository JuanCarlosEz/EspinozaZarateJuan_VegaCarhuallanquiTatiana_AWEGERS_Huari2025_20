@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-green-700">📋 Listado de planificaciones</h1>
        <a href="{{ route('planificaciones.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            + Nueva planificación
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($planificaciones->isEmpty())
        <p class="text-gray-600">No hay planificaciones registradas.</p>
    @else
        <table class="min-w-full border border-gray-300 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Zona</th>
                    <th class="border px-4 py-2">Frecuencia</th>
                    <th class="border px-4 py-2">Hora Inicio</th>
                    <th class="border px-4 py-2">Hora Fin</th>
                    <th class="border px-4 py-2">Fechas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planificaciones as $p)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $p->id }}</td>
                    <td class="border px-4 py-2">{{ $p->zona->nombre ?? 'Sin zona' }}</td>
                    <td class="border px-4 py-2">{{ $p->frecuencia }}</td>
                    <td class="border px-4 py-2">{{ $p->hora_inicio }}</td>
                    <td class="border px-4 py-2">{{ $p->hora_fin }}</td>
                    <td class="border px-4 py-2">
                        {{ $p->fecha_inicio ?? '-' }} → {{ $p->fecha_fin ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
