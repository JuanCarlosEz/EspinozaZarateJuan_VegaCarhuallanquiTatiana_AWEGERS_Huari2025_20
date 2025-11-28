@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar sesión</h1>

        <!-- Mensaje de estado (ej: sesión cerrada correctamente) -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" type="checkbox" name="remember"
                    class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                    Recuérdame
                </label>
            </div>

            <!-- Opciones -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Iniciar sesión
                </button>
            </div>
        </form>

        <!-- Registro -->
        <p class="mt-6 text-center text-sm text-gray-600">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-green-600 hover:underline">Regístrate aquí</a>
        </p>
    </div>
</div>
@endsection
