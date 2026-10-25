@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:700px; margin:auto;">
    <h2 style="color:#0D47A1;">⏰ Horarios</h2>
    <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        @foreach($horarios as $h)
            <div style="padding:14px 16px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; gap:15px;">
                <span style="line-height:1.4; color:#333;">
                    {{ $h->ruta->nombre ?? 'Ruta' }} - {{ $h->parada->nombre ?? '' }}
                </span>
                <b style="white-space:nowrap; flex-shrink:0; background:#E3F2FD; color:#0D47A1; padding:5px 12px; border-radius:20px; font-size:14px;">
                    {{ \Carbon\Carbon::parse($h->hora_salida)->format('g:i A') }}
                </b>
            </div>
        @endforeach
    </div>
    <br>
   <br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>
@endsection
