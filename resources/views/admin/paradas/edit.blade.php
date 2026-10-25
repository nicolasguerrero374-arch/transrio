@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Editar Parada: {{ $parada->nombre }}</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.paradas.update', $parada) }}" enctype="multipart/form-data" style="display:grid; gap:15px;">
            @csrf @method('PUT')
            <div><label style="font-weight:bold;">Nombre</label><input type="text" name="nombre" value="{{ $parada->nombre }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div><label style="font-weight:bold;">Latitud</label><input type="text" name="lat" value="{{ $parada->lat }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
                <div><label style="font-weight:bold;">Longitud</label><input type="text" name="lng" value="{{ $parada->lng }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            </div>

            <div><label style="font-weight:bold;">Tipo</label><input type="text" name="tipo" value="{{ $parada->tipo }}" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Descripción</label><textarea name="descripcion" rows="3" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">{{ $parada->descripcion }}</textarea></div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div><label style="font-weight:bold;">Hora Primera</label><input type="time" name="hora_primera" value="{{ $parada->hora_primera }}" style="width:100%; padding:10px; border-radius:8px;"></div>
                <div><label style="font-weight:bold;">Hora Última</label><input type="time" name="hora_ultima" value="{{ $parada->hora_ultima }}" style="width:100%; padding:10px; border-radius:8px;"></div>
            </div>

            <div>
                <label style="font-weight:bold;">Foto (opcional)</label>
                @if($parada->foto)
                <br><img src="{{ asset('storage/'.$parada->foto) }}" style="width:80px; height:80px; border-radius:6px; margin-bottom:5px;">
                @endif
                <input type="file" name="foto" accept="image/*" style="width:100%; padding:10px; border-radius:8px;">
            </div>

            <button type="submit" style="background:#0D47A1;color:white;padding:12px;border:none;border-radius:10px;cursor:pointer;font-weight:bold;">Actualizar Parada</button>
        </form>
    </div>
    <br><a href="{{ route('admin.paradas.index') }}" style="color:#0D47A1;">← Volver a paradas</a>
</div>
@endsection
