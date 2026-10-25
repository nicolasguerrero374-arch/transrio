@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Editar Número: {{ $numero->nombre }}</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.numeros.update', $numero) }}" style="display:grid; gap:15px;">
            @csrf @method('PUT')
            <div><label style="font-weight:bold;">Nombre</label><input type="text" name="nombre" value="{{ $numero->nombre }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Número</label><input type="text" name="numero" value="{{ $numero->numero }}" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div><label style="font-weight:bold;">Tipo</label><input type="text" name="tipo" value="{{ $numero->tipo }}" placeholder="Taxi, MotoTaxi" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></div>
            <div>
                <label style="font-weight:bold;">Parada (opcional)</label>
                <select name="parada_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
                    <option value="">--- General ---</option>
                    @foreach($paradas as $p)
                    <option value="{{ $p->id }}" {{ $numero->parada_id == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#0D47A1;color:white;padding:12px;border:none;border-radius:10px;cursor:pointer;font-weight:bold;">Actualizar Número</button>
        </form>
    </div>
    <br><a href="{{ route('admin.numeros.index') }}" style="color:#0D47A1;">← Volver a números</a>
</div>
@endsection
