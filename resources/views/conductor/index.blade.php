@extends('layouts.app')

@section('content')
<div style="padding:80px 20px 20px; max-width:600px; margin:0 auto;">
    <h1>🚌 Panel del Conductor</h1>
    <br>
    <p>Hola {{ auth()->user()->name }}</p>

    <div id="estado" style="background:#f3f4f6; padding:15px; border-radius:10px; margin:15px 0;">
        Estado: <b id="textoEstado">Detenido</b>
    </div>

    <div style="margin-bottom:15px;">
        <label style="font-weight:bold;">🚌 Selecciona tu Ruta:</label>
        <select id="rutaSelect" class="form-control" style="padding:10px; border-radius:10px;">
            <option value="">-- Elige una ruta --</option>
            @foreach($rutas as $ruta)
            <option value="{{ $ruta->id }}">{{ $ruta->nombre }} - {{ $ruta->placa }}</option>
            @endforeach
        </select>
    </div>

    <div style="display:flex; gap:10px; margin-bottom:20px;">
        <button id="btnIniciar" onclick="iniciarRuta()" style="flex:1; background:#22c55e; color:white; padding:15px; border-radius:12px; font-weight:bold; border:none; cursor:pointer;">
            🟢 INICIAR RUTA EN VIVO
        </button>
        <button id="btnDetener" onclick="detenerRuta()" style="flex:1; background:#ef4444; color:white; padding:15px; border-radius:12px; font-weight:bold; border:none; cursor:pointer; display:none;">
            🔴 DETENER
        </button>
    </div>

    <div id="mapConductor" style="height:400px; border-radius:15px; border:2px solid #ddd;"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let mapCond, markerCond, watchIdCond = null;

    function initMapConductor() {
        mapCond = L.map('mapConductor').setView([5.423, -75.701], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapCond);
    }

    function iniciarRuta() {
        let rutaElegida = document.getElementById('rutaSelect').value;
        if (!rutaElegida) {
            alert('¡selecciona una ruta primero!');
            return;
        }
        document.getElementById('textoEstado').innerText = 'EN VIVO - Transmitiendo';
        document.getElementById('textoEstado').style.color = 'green';
        document.getElementById('btnIniciar').style.display = 'none';
        document.getElementById('btnDetener').style.display = 'block';
        watchIdCond = navigator.geolocation.watchPosition(async (pos) => {
            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;
            if (!markerCond) {
                markerCond = L.marker([lat, lng]).addTo(mapCond);
            } else {
                markerCond.setLatLng([lat, lng]);
            }
            mapCond.setView([lat, lng], 16);
           await fetch('/conductor/update', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    },
    credentials: 'same-origin',
    body: JSON.stringify({
        lat,
        lng,
        ruta_id: document.getElementById('rutaSelect').value
    })
});
        }, () => alert('Activa el GPS por favor'), {
            enableHighAccuracy: true
        });
    }

    function detenerRuta() {
        document.getElementById('textoEstado').innerText = 'Detenido';
        document.getElementById('btnIniciar').style.display = 'block';
        document.getElementById('btnDetener').style.display = 'none';
        if (watchIdCond !== null) navigator.geolocation.clearWatch(watchIdCond);
    }

    document.addEventListener('DOMContentLoaded', initMapConductor);
</script>
@endsection
