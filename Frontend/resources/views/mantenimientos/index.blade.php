@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-700">🧰 Listado de Mantenimientos</h1>
        <a href="{{ route('mantenimientos.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            + Nuevo Mantenimiento
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($mantenimientos->isEmpty())
        <p class="text-gray-600 italic">No hay mantenimientos registrados.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Vehículo</th>
                        <th class="border px-4 py-2 text-left">Tipo</th>
                        <th class="border px-4 py-2 text-left">Fecha</th>
                        <th class="border px-4 py-2 text-left">Responsable</th>
                        <th class="border px-4 py-2 text-left">Costo (S/)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimientos as $m)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $m->id }}</td>
                        <td class="border px-4 py-2">{{ $m->vehiculo }}</td>
                        <td class="border px-4 py-2">{{ $m->tipo_mantenimiento }}</td>
                        <td class="border px-4 py-2">{{ $m->fecha }}</td>
                        <td class="border px-4 py-2">{{ $m->responsable }}</td>
                        <td class="border px-4 py-2">{{ $m->costo_aproximado }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
