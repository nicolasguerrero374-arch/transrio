@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Nueva Parada</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.paradas.store') }}" enctype="multipart/form-data" style="display:grid; gap:15px;">
            @csrf
            <div><label style="font-weight:bold;">Nombre</label><input type="text" name="nombre" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div><label style="font-weight:bold;">Latitud</label><input type="text" name="lat" placeholder="3.4516" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
                <div><label style="font-weight:bold;">Longitud</label><input type="text" name="lng" placeholder="-76.5319" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            </div>
            <div><label style="font-weight:bold;">Tipo</label><input type="text" name="tipo" placeholder="taxi,mototaxi" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Descripción</label><textarea name="descripcion" rows="3" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></textarea></div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div><label style="font-weight:bold;">Hora Primera</label><input type="time" name="hora_primera" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
                <div><label style="font-weight:bold;">Hora Última</label><input type="time" name="hora_ultima" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            </div>
            <div><label style="font-weight:bold;">Foto (opcional)</label><input type="file" name="foto" accept="image/*" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <button type="submit" style="background:#0D47A1;color:white;padding:12px;border:none;border-radius:10px;cursor:pointer;font-weight:bold;">Guardar Parada</button>
        </form>
    </div>
    <br><a href="{{ route('admin.paradas.index') }}" style="color:#0D47A1;">← Volver a paradas</a>
</div>
@endsection
