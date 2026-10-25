@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:900px; margin:auto;">
  <h2 style="color:#0D47A1; margin-bottom:15px;">🚌 Paradas</h2>
  <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:15px;">
    @forelse($paradas as $p)
      <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        @if($p->foto)
          <img src="{{ asset('storage/'.$p->foto) }}" style="width:100%; height:160px; object-fit:cover;">
        @else
          <div style="width:100%; height:160px; background:#E3F2FD; display:flex; align-items:center; justify-content:center; font-size:40px;">📍</div>
        @endif
        <div style="padding:15px;">
          <h3 style="margin:0 0 5px 0; color:#0D47A1;">{{ $p->nombre }}</h3>
          <p style="margin:0; color:#666; font-size:13px;">{{ $p->tipo }} - {{ $p->descripcion }}</p>
          <p style="margin:8px 0 0 0; font-size:12px; color:#888;">🕒 {{ $p->hora_primera }} - {{ $p->hora_ultima }}</p>
          <a href="{{ url('/?parada='.$p->id) }}" style="display:block; margin-top:10px; background:#0D47A1; color:white; text-align:center; padding:8px; border-radius:8px; text-decoration:none; font-size:13px;">Ver en Mapa</a>
        </div>
      </div>
    @empty
      <p>No hay paradas registradas aún.</p>
    @endforelse
  </div>
  <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>
@endsection
