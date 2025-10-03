@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestión de Roles</h2>
@endsection

@section('content')
<div class="bg-white shadow rounded p-6">
    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Rol actual</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border align-top">{{ $usuario->id }}</td>
                        <td class="px-4 py-2 border align-top">
                            {{ $usuario->nombres ?? $usuario->name ?? '' }}
                            <div class="text-sm text-gray-500">{{ $usuario->apellido_paterno ?? '' }} {{ $usuario->apellido_materno ?? '' }}</div>
                        </td>
                        <td class="px-4 py-2 border align-top">{{ $usuario->email }}</td>
                        <td class="px-4 py-2 border align-top">
                            {{-- Mostrar rol principal: primero Spatie, si no el campo role --}}
                            @if(method_exists($usuario, 'getRoleNames'))
                                {{ $usuario->getRoleNames()->first() ?? ($usuario->role ?? '—') }}
                            @else
                                {{ $usuario->role ?? '—' }}
                            @endif
                        </td>
                        <td class="px-4 py-2 border align-top">
                            <form action="{{ route('roles.update', $usuario->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                {{-- Select con roles disponibles --}}
                                <select name="role" class="border rounded px-2 py-1">
                                    @foreach($roles as $r)
                                        <option value="{{ $r }}" {{ ( (method_exists($usuario, 'getRoleNames') && $usuario->getRoleNames()->first() == $r) || ($usuario->role ?? '') == $r) ? 'selected' : '' }}>
                                            {{ ucfirst($r) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Guardar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
