@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-green-700">📍 Listado de Zonas</h1>
        <a href="{{ route('zonas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            ➕ Nueva Zona
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($zonas->isEmpty())
        <p class="text-gray-600">No hay zonas registradas aún.</p>
    @else
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Nombre</th>
                    <th class="border px-4 py-2 text-center">Prioritaria</th>
                    <th class="border px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($zonas as $zona)
                <tr class="border-b hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $zona->id }}</td>
                    <td class="border px-4 py-2">{{ $zona->nombre }}</td>
                    <td class="border px-4 py-2 text-center">
                        @if($zona->prioritaria)
                            <span class="text-green-600 font-semibold">Sí</span>
                        @else
                            <span class="text-gray-500">No</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('zonas.edit', $zona->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('zonas.destroy', $zona->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
