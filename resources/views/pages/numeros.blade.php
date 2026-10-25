@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:700px; margin:auto;">
    <h2 style="color:#0D47A1;">📞 Números de Contacto</h2>

    <!-- pestañas -->
    <div style="display:flex; gap:8px; margin:15px 0; overflow-x:auto; padding-bottom:10px;">
        <button onclick="filtrar('todos')" id="btn-todos" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:#0d47a1; color:white; font-weight:bold; cursor:pointer;">Todos</button>
        <button onclick="filtrar('bus')" id="btn-bus" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer;">🚌 Bus</button>
        <button onclick="filtrar('taxi')" id="btn-taxi" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer;">🚕 Taxi</button>
        <button onclick="filtrar('mototaxi')" id="btn-mototaxi" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer;">🏍️ Mototaxi</button>
        <button onclick="filtrar('jeep')" id="btn-jeep" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer;">🚙 Jeep</button>
        <button onclick="filtrar('pirata')" id="btn-pirata" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer;">🏴‍☠️ Pirata</button>


    </div>

    <div style="display:grid; gap:10px;">
        @foreach($numeros as $n)
        <div class="item-numero" data-tipo="{{ $n->tipo }}" style="background:white; padding:15px 18px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div style="line-height:1.5;">
                    <b style="font-size:16px;">{{ $n->nombre }}</b><br>
                    <small style="color:#666; text-transform:capitalize;">{{ $n->tipo }}</small><br>
                    <span style="font-size:15px; color:#0D47A1; font-weight:bold; letter-spacing:0.5px;">{{ $n->numero }}</span>
                </div>
                <a href="tel:{{ $n->telefono }}" style="background:#2E7D32; color:white; padding:10px 18px; border-radius:25px; text-decoration:none; font-weight:bold;">
                    Llamar
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>

<script>
    function filtrar(tipo) {
        document.querySelectorAll('.item-numero').forEach(item => {
            item.style.display = (tipo === 'todos' || item.dataset.tipo === tipo) ? 'block' : 'none';
        });

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.style.background = 'white';
            btn.style.color = '#0d47a1';
        });
        let activo = document.getElementById('btn-' + tipo);
        if (activo) {
            activo.style.background = '#0d47a1';
            activo.style.color = 'white';
        }
    }
</script>
@endsection
