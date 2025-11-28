@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Gestión de Roles
    </h2>
@endsection

@section('content')
<div class="bg-white shadow rounded p-6">
    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
            {{ session('error') }}
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
                    @php
                        // Detectar el rol actual correctamente
                        $rolActual = method_exists($usuario, 'getRoleNames') 
                            ? $usuario->getRoleNames()->first() 
                            : ($usuario->role ?? '—');

                        // Convertir a minúsculas para evitar diferencias de formato
                        $rolNormalizado = strtolower($rolActual);
                    @endphp

                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border align-top">{{ $usuario->id }}</td>

                        <td class="px-4 py-2 border align-top">
                            {{ $usuario->nombres ?? $usuario->name ?? '' }}
                            <div class="text-sm text-gray-500">
                                {{ $usuario->apellido_paterno ?? '' }} {{ $usuario->apellido_materno ?? '' }}
                            </div>
                        </td>

                        <td class="px-4 py-2 border align-top">{{ $usuario->email }}</td>

                        <td class="px-4 py-2 border align-top">
                            <span class="font-medium text-gray-800">
                                {{ ucfirst($rolActual) }}
                            </span>
                        </td>

                        <td class="px-4 py-2 border align-top">
                            <form action="{{ route('roles.update', $usuario->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                
                                {{-- Desactivar si el usuario es "administrador" --}}
                                <select 
                                    name="role" 
                                    class="border rounded px-2 py-1"
                                    {{ $rolNormalizado === 'administrador' ? 'disabled' : '' }}>
                                    @foreach(['ciudadano', 'conductor'] as $r)
                                        <option value="{{ $r }}" {{ $rolNormalizado == $r ? 'selected' : '' }}>
                                            {{ ucfirst($r) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button 
                                    type="submit" 
                                    class="px-3 py-1 rounded text-white 
                                           {{ $rolNormalizado === 'administrador' ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}" 
                                    {{ $rolNormalizado === 'administrador' ? 'disabled' : '' }}>
                                    Guardar
                                </button>
                            </form>

                            {{-- Texto informativo si es administrador --}}
                            @if($rolNormalizado === 'administrador')
                                <p class="text-xs text-gray-500 italic mt-1">
                                    No editable (Administrador)
                                </p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
