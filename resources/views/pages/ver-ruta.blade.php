@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('/rutas') }}" class="btn btn-secondary mb-3">← Volver</a>

    <h3>Ruta: {{ $ruta->nombre }} <span style="background: {{ $ruta->color }}; padding: 5px 15px; border-radius: 10px;"></span></h3>
    <p><strong>Placa:</strong> {{ $ruta->placa }} | {{ $ruta->descripcion }}</p>

    <div id="map" style="height: 550px; border-radius: 15px;"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([3.4516, -76.5320], 13); // Cali
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch('/api/rutas/{{ $ruta->id }}')
        .then(res => res.json())
        .then(ruta => {
            // Si tu campo se llama coordenadas, recorrido o polyline, esto lo adapta
            let coords = ruta.coordenadas || ruta.recorrido || ruta.path || ruta.polyline;
            if (typeof coords === 'string') {
                coords = JSON.parse(coords);
            }
            if (coords && coords.length > 0) {
                let linea = L.polyline(coords, {
                    color: ruta.color || 'blue',
                    weight: 6
                }).addTo(map);
                map.fitBounds(linea.getBounds());
            }
        });
</script>
@endsection
