@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-center">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6">
                        Sistema de Monitoreo y Gestión de Residuos en Tiempo Real
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                        Esta plataforma permite visualizar en tiempo real la ubicación y el estado 
                        de los vehículos recolectores de residuos sólidos en la ciudad de Huari 🚛.  
                        Con esta herramienta se busca optimizar la recolección, mejorar la eficiencia 
                        de las rutas y contribuir a un entorno más limpio y sostenible 🌍.
                    </p>
                    <a href="{{ url('/vehiculos/mapa') }}" 
                       class="px-8 py-3 bg-green-600 text-white text-lg rounded-lg shadow hover:bg-green-700 transition">
                        Ver Vehículos en el Mapa
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
