@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Editar Ruta: {{ $ruta->nombre }}</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.rutas.update', $ruta) }}" style="display:grid; gap:15px;">
            @csrf @method('PUT')

            <div><label style="font-weight:bold;">Nombre de la Ruta</label><input type="text" name="nombre" value="{{ $ruta->nombre }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div><label style="font-weight:bold;">Placa</label><input type="text" name="placa" value="{{ $ruta->placa }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
                <div><label style="font-weight:bold;">Color</label><input type="text" name="color" value="{{ $ruta->color }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            </div>

            <div><label style="font-weight:bold;">Coordenadas (JSON)</label><textarea name="coordenadas" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; min-height:120px;">{{ is_array($ruta->coordenadas) ? json_encode($ruta->coordenadas, JSON_PRETTY_PRINT) : $ruta->coordenadas }}</textarea></div>

            <div><label style="font-weight:bold;">Descripción</label><textarea name="descripcion" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">{{ $ruta->descripcion }}</textarea></div>

            <button type="submit" style="background:#0D47A1;color:white;padding:12px;border:none;border-radius:10px;cursor:pointer;font-weight:bold;">Actualizar Ruta</button>
        </form>
    </div>
    <br><a href="{{ route('admin.rutas.index') }}" style="color:#0D47A1;">← Volver a rutas</a>
</div>
@endsection
