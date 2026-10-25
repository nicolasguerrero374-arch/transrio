@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Editar Tarifa</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.tarifas.update', $tarifa) }}" style="display:grid; gap:15px;">
            @csrf @method('PUT')
            <div><label style="font-weight:bold;">Destino</label><input type="text" name="destino" value="{{ $tarifa->destino }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Precio</label><input type="number" step="0.01" name="precio" value="{{ $tarifa->precio }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Tipo</label><input type="text" name="tipo" value="{{ $tarifa->tipo }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <button type="submit" style="background:#0D47A1;color:white;padding:12px;border:none;border-radius:10px;cursor:pointer;font-weight:bold;">Actualizar Tarifa</button>
        </form>
    </div>
    <br><a href="{{ route('admin.tarifas.index') }}" style="color:#0D47A1;">← Volver a tarifas</a>
</div>
@endsection
