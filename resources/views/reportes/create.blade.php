@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
    <h1 class="text-2xl font-bold text-green-700 mb-6">📍 Registrar nuevo reporte ciudadano</h1>

    <form action="{{ route('reportes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Tipo de incidencia --}}
        <div>
            <label class="block font-semibold text-gray-700">Tipo de incidencia</label>
            <select name="tipo_incidencia" class="w-full border-gray-300 rounded p-2 mt-1 focus:ring-green-500 focus:border-green-500">
                <option value="">Seleccione un tipo</option>
                <option value="Acumulación de residuos">Acumulación de residuos</option>
                <option value="Contenedor dañado">Contenedor dañado</option>
                <option value="Recolección tardía">Recolección tardía</option>
                <option value="Otro">Otro</option>
            </select>
            @error('tipo_incidencia') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block font-semibold text-gray-700">Descripción</label>
            <textarea name="descripcion" class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500" rows="3"></textarea>
        </div>

        {{-- Prioridad --}}
        <div>
            <label class="block font-semibold text-gray-700">Nivel de prioridad</label>
            <select name="nivel_prioridad" class="w-full border-gray-300 rounded p-2 mt-1 focus:ring-green-500 focus:border-green-500">
                <option value="bajo">Bajo</option>
                <option value="medio">Medio</option>
                <option value="alto">Alto</option>
            </select>
        </div>

        {{-- Zona --}}
        <div>
            <label class="block font-semibold text-gray-700">Zona</label>
            <select name="zona_id" class="w-full border-gray-300 rounded p-2 mt-1 focus:ring-green-500 focus:border-green-500">
                <option value="">Seleccione una zona</option>
                @foreach ($zonas as $zona)
                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Referencia --}}
        <div>
            <label class="block font-semibold text-gray-700">Referencia (opcional)</label>
            <input type="text" name="referencia" class="w-full border-gray-300 rounded p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block font-semibold text-gray-700">Foto de evidencia</label>
            <input type="file" name="foto" id="fotoInput" class="w-full border-gray-300 rounded p-2">
            <img id="preview" class="hidden mt-2 rounded-lg border w-48" />
        </div>

        {{-- Mapa --}}
        <div>
            <label class="block font-semibold text-gray-700">Ubicación en el mapa</label>
            <input type="text" id="ubicacion" name="ubicacion" class="w-full border rounded p-2" readonly placeholder="Haz clic en el mapa">
            <div id="mapa" class="w-full h-64 mt-2 border rounded"></div>
        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Guardar reporte
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('mapa').setView([-9.316, -77.17], 13); // Huari, Ancash
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    var marker;

    map.on('click', function(e) {
        document.getElementById('ubicacion').value = e.latlng.lat + ',' + e.latlng.lng;
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);
    });

    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
});
</script>
@endsection
