@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:900px; margin:auto;">
    <h2>Nueva Ruta</h2>
    <div style="background:white; padding:25px; border-radius:12px;">
        <form method="POST" action="{{ route('admin.rutas.store') }}" style="display:grid; gap:15px;">
            @csrf
            <div>
                <label>Nombre</label>
                <input type="text" name="nombre" required placeholder="Ej: Riosucio - Manizales" style="width:100%; padding:10px;">
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div>
                    <label>Placa</label>
                    <input type="text" name="placa" placeholder="ABC-123" style="width:100%; padding:10px;">
                </div>
                <div>
                    <label>Color</label>
                    <input type="color" name="color" value="#ff0000" style="width:100%; height:45px;">
                </div>
            </div>

            <div>
                <label>Coordenadas (Haz clic en el mapa de abajo)</label>
                <textarea id="coords" name="coordenadas" readonly style="width:100%; height:80px; background:#f5f5f5;"></textarea>
                <button type="button" onclick="limpiar()" style="margin-top:5px;">Limpiar trayecto</button>
                <div id="mapaCrear" style="width:100%; height:400px; margin-top:10px; border-radius:8px;"></div>
                <p style="font-size:12px; color:gray;">Cada clic agrega un punto a la ruta del bus.</p>
            </div>

            <div>
                <label>Descripción</label>
                <textarea name="descripcion" style="width:100%; padding:10px;"></textarea>
            </div>
            <button type="submit" style="background:#0047a1; color:white; padding:12px; border:none; border-radius:8px; font-weight:bold;">Guardar Ruta</button>
        </form>
    </div>
    <a href="{{ route('admin.rutas.index') }}">Volver a rutas</a>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let mapC = L.map('mapaCrear').setView([5.422, -75.702, ], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapC);
    let puntos = [];
    let linea = L.polyline([], {
        color: 'red'
    }).addTo(mapC);

    mapC.on('click', function(e) {
        puntos.push([e.latlng.lat, e.latlng.lng]);
        linea.setLatLngs(puntos);
        document.getElementById('coords').value = JSON.stringify(puntos);
    });

    function limpiar() {
        puntos = [];
        linea.setLatLngs([]);
        document.getElementById('coords').value = '';
    }
</script>
@endsection
