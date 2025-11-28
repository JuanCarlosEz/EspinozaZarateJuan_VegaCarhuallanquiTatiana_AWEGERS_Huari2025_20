@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Mapa de Huari</h1>
    <div id="map" style="height: 500px;"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var map = L.map('map').setView([-12.06513, -75.20486], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([-12.06513, -75.20486]).addTo(map)
            .bindPopup("Estamos aquí 📍")
            .openPopup();
    });
</script>
@endsection
