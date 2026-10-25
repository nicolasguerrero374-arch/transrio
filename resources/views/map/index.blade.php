@extends('layouts.app')
@section('content')
<!--ENTRADA TRANSRIO -->
<link rel="stylesheet" href="{{ asset('css/transrio-entrada.css') }}">
<div id="transrio-entrada">
    <div class="entrada-bg"></div>
    <div class="entrada-overlay"></div>
    <div class="entrada-content">
        <div class="entrada-logo">
            <h1><i class="bi bi-bus-front" style="color:white;"></i> TransRio</h1>
            <span>RIOSUCIO</span>
        </div>
        <div class="entrada-frases">
            <div class="frase">¿Necesitas transporte?</div>
            <div class="frase">Te podemos ayudar</div>
            <div class="frase">Mira todas las paradas que hay</div>
        </div>
        <div class="entrada-loader">
            <div class="entrada-loader-bar"></div>
        </div>
    </div>
</div>

<!-- Mapa principal -->
<div class="search-container">
    <div class="search-box">
        <input type="text" id="buscadorDestino" placeholder="¿A dónde vas? Ej: Supía">
        <button onclick="buscarDestino()">🔍</button>
    </div>
    <div class="search-box">
        <input type="text" id="buscadorTransporte" placeholder="¿Qué transporte? Ej: Taxi">
        <button onclick="filtrarTransporte()">🔍</button>
    </div>
    <div id="sugerencia" class="sugerencia hidden"></div>
</div>
<div id="map"></div>

<!-- Modal Parada -->
<div id="modalParada" class="modal hidden">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h3 id="modalNombre"></h3>
        <img id="modalFoto" src="" alt="" style="width:100%; height:200px; object-fit:cover; border-radius:8px;">
        <p><b>Rutas:</b> <span id="modalRutas"></span></p>
        <p><b>Primera:</b> <span id="modalPrimera"></span> | <b>Última:</b> <span id="modalUltima"></span></p>
        <p><b>Total rutas:</b> <span id="modalTotal"></span></p>
    </div>
</div>
<script src="{{ asset('js/transrio-entrada.js') }}"></script>
@endsection
