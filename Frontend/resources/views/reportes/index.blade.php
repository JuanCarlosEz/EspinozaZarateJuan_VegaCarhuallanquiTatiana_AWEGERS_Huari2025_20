@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Listado de Reportes</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('reportes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Nuevo Reporte
        </a>
    </div>

    @if ($reportes->isEmpty())
        <p class="text-gray-500">No hay reportes registrados.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($reportes as $reporte)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold text-green-700">{{ $reporte->tipo }}</h2>
                    <p class="text-gray-600">{{ $reporte->descripcion }}</p>
                    <p class="text-sm text-gray-400 mt-2">Zona: {{ $reporte->zona->nombre ?? 'Sin zona' }}</p>
                    <a href="{{ route('reportes.show', $reporte->id) }}" class="text-green-600 hover:underline mt-2 inline-block">
                        Ver detalles
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
