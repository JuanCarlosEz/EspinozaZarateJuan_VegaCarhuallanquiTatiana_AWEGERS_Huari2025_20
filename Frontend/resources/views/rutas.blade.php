@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Generador de Rutas</h2>
@endsection

@section('content')
<div class="flex gap-6">

    <!-- Sidebar -->
    <aside class="w-full md:w-96 bg-white rounded-lg shadow p-4 overflow-auto" style="max-height:80vh;">
        <h3 class="text-lg font-bold mb-4">Generar Ruta entre dos puntos</h3>

        <!-- ORIGEN -->
        <label class="font-semibold">Origen:</label>
        <input id="origen" type="text"
               class="w-full mb-3 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-green-400"
               placeholder="Selecciona en el mapa o escribe">

        <!-- DESTINO -->
        <label class="font-semibold">Destino:</label>
        <input id="destino" type="text"
               class="w-full mb-3 px-3 py-2 border rounded focus:outline-none focus:ring focus:border-green-400"
               placeholder="Selecciona en el mapa o escribe">

        <!-- Botón -->
        <button onclick="calcularRuta()"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded mt-2">
            Generar Ruta
        </button>

        <button onclick="limpiarRuta()"
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 rounded mt-3">
            Limpiar Ruta
        </button>

        <p class="text-sm text-gray-600 mt-4">
            🟢 Haz clic en el mapa para seleccionar primero el <b>Origen</b> y luego el <b>Destino</b>.
        </p>
    </aside>

    <!-- Mapa -->
    <div class="flex-1">
        <div id="map" class="w-full h-[80vh] rounded-lg shadow"></div>
    </div>
</div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Librería para rutas: Leaflet Routing Machine -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var map = L.map('map').setView([-12.06, -75.20], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var controlRuta = null;

    // Marcadores de ORIGEN y DESTINO
    var marcadorOrigen = null;
    var marcadorDestino = null;

    // Alternador: 0 = origen, 1 = destino
    var seleccion = 0;

    map.on('click', async function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Convertir coordenadas a dirección
        const direccion = await reverseGeocode(lat, lng);

        if (seleccion === 0) {
            // ORIGEN
            document.getElementById("origen").value = direccion;
            if (marcadorOrigen) map.removeLayer(marcadorOrigen);
            marcadorOrigen = L.marker([lat, lng], { draggable: true }).addTo(map);

            marcadorOrigen.on("moveend", async function(evt) {
                const pos = evt.target.getLatLng();
                document.getElementById("origen").value = await reverseGeocode(pos.lat, pos.lng);
            });

            seleccion = 1; // pasa a seleccionar destino

        } else {
            // DESTINO
            document.getElementById("destino").value = direccion;
            if (marcadorDestino) map.removeLayer(marcadorDestino);
            marcadorDestino = L.marker([lat, lng], { draggable: true }).addTo(map);

            marcadorDestino.on("moveend", async function(evt) {
                const pos = evt.target.getLatLng();
                document.getElementById("destino").value = await reverseGeocode(pos.lat, pos.lng);
            });

            seleccion = 0; // vuelve a origen
        }
    });


    // ---------------------------
    //   Generar RUTA
    // ---------------------------
    window.calcularRuta = function() {
        const origen = document.getElementById("origen").value;
        const destino = document.getElementById("destino").value;

        if (!origen || !destino) {
            alert("Debes ingresar el origen y destino");
            return;
        }

        if (controlRuta) map.removeControl(controlRuta);

        controlRuta = L.Routing.control({
            waypoints: [],
            lineOptions: { styles: [{ color: 'green', weight: 4 }] },
            show: false,
            addWaypoints: false,
        }).addTo(map);

        Promise.all([ geocode(origen), geocode(destino) ])
            .then(([o, d]) => {
                controlRuta.setWaypoints([
                    L.latLng(o.lat, o.lng),
                    L.latLng(d.lat, d.lng)
                ]);
            })
            .catch(() => alert("No se pudo encontrar coordenadas."));
    };


    // ---------------------------
    //   LIMPIAR
    // ---------------------------
    window.limpiarRuta = function() {
        if (controlRuta) {
            map.removeControl(controlRuta);
            controlRuta = null;
        }
        if (marcadorOrigen) map.removeLayer(marcadorOrigen);
        if (marcadorDestino) map.removeLayer(marcadorDestino);
        marcadorOrigen = null;
        marcadorDestino = null;
        document.getElementById("origen").value = "";
        document.getElementById("destino").value = "";
        seleccion = 0;
    };


    // ---------------------------
    //   GEOCODING
    // ---------------------------
    async function geocode(query) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;
        const res = await fetch(url);
        const data = await res.json();
        if (!data.length) throw new Error("No encontrado");
        return { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };
    }

    async function reverseGeocode(lat, lng) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;
        const res = await fetch(url);
        const data = await res.json();
        return data.display_name ?? (lat + "," + lng);
    }

});
</script>
@endsection
