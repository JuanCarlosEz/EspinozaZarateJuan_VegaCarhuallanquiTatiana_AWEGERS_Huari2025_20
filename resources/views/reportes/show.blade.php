@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-green-700">{{ $reporte->tipo }}</h1>

    <p class="mb-2"><strong>Descripción:</strong> {{ $reporte->descripcion }}</p>
    <p class="mb-2"><strong>Zona:</strong> {{ $reporte->zona->nombre ?? 'Sin zona asignada' }}</p>
    <p class="mb-4"><strong>Ubicación:</strong> {{ $reporte->ubicacion }}</p>

    @if ($reporte->foto)
    <img src="{{ asset('storage/' . $reporte->foto) }}" alt="Foto del reporte" class="rounded-lg mb-4 w-full">
@endif

    <a href="{{ route('reportes.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        ← Volver
    </a>
</div>
@endsection
