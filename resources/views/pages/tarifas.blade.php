@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:700px; margin:auto;">
    <h2 style="color:#0D47A1;">💰 Tarifas</h2>

    <!-- pestañas -->
    <div style="display:flex; gap:8px; margin-bottom:15px; overflow-x:auto;">
        <button onclick="filtrar('todos')" id="btn-todos" class="tab-btn active" style="padding:8px 16px; border-radius:20px; border:1px solid #0D47A1; background:#0D47A1; color:white; font-weight:bold; cursor:pointer; white-space:nowrap;">Todos</button>
        <button onclick="filtrar('bus')" id="btn-bus" class="tab-btn" style="padding:8px 16px; border-radius:20px; border:1px solid #0D47A1; background:white; color:#0D47A1; font-weight:bold; cursor:pointer; white-space:nowrap;">🚌 Bus</button>
        <button onclick="filtrar('taxi')" id="btn-taxi" class="tab-btn" style="padding:8px 16px; border-radius:20px; border:1px solid #0D47A1; background:white; color:#0D47A1; font-weight:bold; cursor:pointer; white-space:nowrap;">🚕 Taxi</button>
        <button onclick="filtrar('mototaxi')" id="btn-mototaxi" class="tab-btn" style="padding:8px 16px; border-radius:20px; border:1px solid #0D47A1; background:white; color:#0D47A1; font-weight:bold; cursor:pointer; white-space:nowrap;">🏍️ Mototaxi</button>
        <button onclick="filtrar('jeep')" id="btn-jeep" class="tab-btn" style="padding:8px 15px; border-radius:20px; border:1px solid #0d47a1; background:white; color:#0d47a1; font-weight:bold; cursor:pointer; white-space:nowrap;">🚙 Jeep</button>
    </div>

    <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        @foreach($tarifas as $t)
        <div class="tarifa-item" data-tipo="{{ strtolower($t->tipo) }}" style="padding:14px 16px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; gap:15px;">
            <span style="line-height:1.4;">
                {{ $t->origen }}-{{ $t->destino }}
                <small style="color:#888;">({{ $t->tipo }})</small>
            </span>
            <b style="white-space:nowrap; color:#0D47A1;">${{ number_format($t->precio, 0, ',', '.') }}</b>
        </div>
        @endforeach
    </div>
    <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>

<!-- Filtro -->
<script>
   function filtrar(tipo) {
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.style.background = 'white';
        b.style.color = '#0D47A1';
        b.style.border = '1px solid #0D47A1';
    });
    document.getElementById('btn-'+tipo).style.background = '#0D47A1';
    document.getElementById('btn-'+tipo).style.color = 'white';

    document.querySelectorAll('.tarifa-item').forEach(item => {
        // CAMBIO IMPORTANTE AQUÍ: === en vez de includes()
        if (tipo === 'todos' || item.dataset.tipo === tipo) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endsection
