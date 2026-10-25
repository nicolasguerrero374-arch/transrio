@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:900px; margin:auto;">
    <h2 style="color:#0D47A1;">🗺️ Rutas</h2>
    @foreach($rutas as $r)
    <div style="background:white; padding:18px 20px; border-radius:12px; margin-bottom:12px; box-shadow:0 2px 8px rgba(0,0,0,0.08); display:flex; justify-content:space-between; align-items:center; gap:10px;">
        <div style="flex:1;">
            <b>{{ $r->nombre }}</b><br>
            <span style="color:#666; font-size:13px;">{{ $r->origen }} -> {{ $r->destino }}</span>
        </div>
        <div style="display:flex; flex-direction:column; gap:6px;">
            <a href="{{ url('/?ruta='.$r->id) }}" style="background:#0047A3; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:13px; text-align:center;">Ver Recorrido</a>
            <a href="{{ url('/?ruta='.$r->id.'&vivo=1') }}" style="background:#00B050; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:13px; text-align:center;">🚌 En Vivo</a>
        </div>
    </div>
    @endforeach
    <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>
@endsection
