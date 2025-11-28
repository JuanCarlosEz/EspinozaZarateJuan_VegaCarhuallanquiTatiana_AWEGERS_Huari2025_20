@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Registrar cuenta') }}
    </h2>
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white shadow rounded-lg p-6 mt-8">

    {{-- Mensaje de registro exitoso --}}
    @if(session('registro_exitoso'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg text-center">
            {{ session('registro_exitoso') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-6 text-center">Crear nueva cuenta</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombres --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nombres</label>
            <input name="nombres" value="{{ old('nombres') }}" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('nombres') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Apellido paterno --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Apellido paterno</label>
            <input name="apellido_paterno" value="{{ old('apellido_paterno') }}" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('apellido_paterno') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Apellido materno --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Apellido materno</label>
            <input name="apellido_materno" value="{{ old('apellido_materno') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('apellido_materno') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- DNI --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">DNI</label>
            <input name="dni" value="{{ old('dni') }}" required maxlength="8"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('dni') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input name="telefono" value="{{ old('telefono') }}" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('telefono') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input name="email" type="email" value="{{ old('email') }}" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('email') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('password') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Confirmación de contraseña --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Repetir contraseña</label>
            <input type="password" name="password_confirmation" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Botón --}}
        <div>
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                Registrarme
            </button>
        </div>
    </form>
</div>
@endsection
