@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Visualización de Vehículos</h2>
@endsection

@section('content')
<div class="flex gap-6">
    <!-- Sidebar -->
    <aside class="w-full md:w-96 bg-white rounded-lg shadow p-4 overflow-auto" style="max-height:80vh;">
        <h3 class="text-lg font-bold mb-3">Vehículos Activos</h3>

        <!-- Campo de búsqueda -->
        <input type="text" id="search-input" placeholder="Buscar por nombre o placa..."
            class="w-full mb-3 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-green-400">

        <div id="vehicle-list" class="space-y-3">
            @foreach($vehiculos as $v)
                @php
                    $dot = $v['status'] === 'activo' ? 'bg-green-500' : ($v['status'] === 'lento' ? 'bg-yellow-500' : 'bg-red-500');
                @endphp

                <div class="vehicle-item flex items-start gap-3 p-3 border rounded hover:shadow cursor-pointer" data-id="{{ $v['id'] }}">
                    <div class="flex-shrink-0">
                        <span class="inline-block w-3 h-3 rounded-full {{ $dot }} mt-1"></span>
                    </div>

                    <div class="flex-1">
                        <div class="font-semibold text-gray-800">{{ $v['nombre'] }}</div>
                        <div class="text-sm text-gray-500">{{ $v['placa'] }}</div>

                        <div class="mt-2 text-sm text-gray-600 bg-blue-50 p-2 rounded">
                            <div>Última actualización: <span class="font-medium text-gray-700">{{ $v['last_update'] }}</span></div>
                            <div>Velocidad: <span class="font-medium text-gray-700">{{ $v['speed'] ?? 'Sin datos' }} {{ $v['speed'] ? 'km/h' : '' }}</span></div>
                            <div class="text-xs text-gray-500 mt-1">Zona: {{ $v['zona'] }}</div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <button class="text-sm text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded view-on-map" data-id="{{ $v['id'] }}">
                            Ver
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Map -->
    <div class="flex-1">
        <div id="map" class="w-full h-[80vh] rounded-lg shadow"></div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
/* pequeño estilo para los markers creados con divIcon */
.marker-dot {
    display: inline-block;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px rgba(0,0,0,0.08);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Datos desde Laravel
    var vehiculos = @json($vehiculos);

    // Crear mapa y centro inteligente en el primer vehículo
    var center = vehiculos.length ? [vehiculos[0].lat, vehiculos[0].lng] : [-12.06513, -75.20486];
    var map = L.map('map').setView(center, 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Mapas de markers por id
    var markers = {};

    // Helper para color por estado
    function colorByStatus(status) {
        if (status === 'activo') return '#10B981'; // green-500
        if (status === 'lento') return '#F59E0B';  // yellow-500
        return '#EF4444'; // red-500
    }

    // Crear markers
    vehiculos.forEach(function(v) {
        var color = colorByStatus(v.status);

        // Use L.divIcon para un punto circular coloreado
        var html = '<div class="marker-dot" style="background:' + color + ';"></div>';
        var icon = L.divIcon({
            html: html,
            className: '', // quitar clase por defecto
            iconSize: [22, 22],
            iconAnchor: [11, 11]
        });

        var marker = L.marker([v.lat, v.lng], { icon: icon }).addTo(map);

        var popupHtml = '<div class="text-sm"><strong>' + v.nombre + '</strong><br/>' +
                        'Placa: ' + v.placa + '<br/>' +
                        'Última: ' + v.last_update + '<br/>' +
                        'Velocidad: ' + (v.speed !== null ? v.speed + ' km/h' : 'Sin datos') +
                        '</div>';

        marker.bindPopup(popupHtml);

        markers[v.id] = {
            marker: marker,
            data: v
        };
    });

    // Click en listado -> centrar y abrir popup
    function focusOnVehicle(id) {
        var entry = markers[id];
        if (!entry) return;
        var latlng = entry.marker.getLatLng();
        map.setView(latlng, 16, { animate: true });
        entry.marker.openPopup();

        // marcar visualmente seleccionado en sidebar
        document.querySelectorAll('.vehicle-item').forEach(function(x){ x.classList.remove('ring','ring-2','ring-green-300'); });
        var parent = document.querySelector('.vehicle-item[data-id="'+id+'"]');
        if (parent) parent.classList.add('ring','ring-2','ring-green-300');
    }

    document.querySelectorAll('.vehicle-item, .view-on-map').forEach(function(el) {
        el.addEventListener('click', function(e) {
            var id = this.dataset.id || this.getAttribute('data-id');
            if (!id) return;
            focusOnVehicle(id);
            e.stopPropagation();
        });
    });

    // Filtro por nombre o placa
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function() {
        var query = this.value.toLowerCase().trim();
        var firstMatchId = null;

        document.querySelectorAll('.vehicle-item').forEach(function(item) {
            var nombre = item.querySelector('.font-semibold').innerText.toLowerCase();
            var placa = item.querySelector('.text-sm.text-gray-500').innerText.toLowerCase();

            if (nombre.includes(query) || placa.includes(query)) {
                item.style.display = 'flex'; // mostrar
                if (!firstMatchId) {
                    firstMatchId = item.dataset.id; // guardar primer match
                }
            } else {
                item.style.display = 'none'; // ocultar
            }
        });

        // Si hay un match, centrar mapa automáticamente en el primer resultado
        if (firstMatchId) {
            focusOnVehicle(firstMatchId);
        }
    });
});
</script>
@endsection
