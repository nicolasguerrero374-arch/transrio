@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Editar Horario</h2>
    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.horarios.update', $horario) }}" style="display:grid; gap:15px;">
            @csrf @method('PUT')
            <div>
                <label>Ruta</label>
                <select name="ruta_id" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    @foreach($rutas as $ruta)
                    <option value="{{ $ruta->id }}" {{ $horario->ruta_id == $ruta->id ? 'selected' : '' }}>{{ $ruta->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Parada</label>
                <select name="parada_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    <option value="">--- Sin parada ---</option>
                    @foreach($paradas as $parada)
                    <option value="{{ $parada->id }}" {{ $horario->parada_id == $parada->id ? 'selected' : '' }}>{{ $parada->nombre ?? $parada->direccion ?? 'Parada '.$parada->id }}</option>
                    @endforeach
                </select>
            </div>
            <div><label>Hora Apertura</label><input type="time" name="hora_apertura" required value="{{ $horario->hora_apertura }}" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;"></div>
            <div><label>Hora Cierre</label><input type="time" name="hora_cierre" required value="{{ $horario->hora_cierre }}" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;"></div>
            <div><label>Hora Salida</label><input type="time" name="hora_salida" value="{{ $horario->hora_salida }}" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;"></div>
            <div><label>Dias</label><input type="text" name="dias" required value="{{ $horario->dias }}" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;"></div>
            <div>
                <label>Tipo</label>
                <select name="tipo" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    <option {{ $horario->tipo == 'Terminal' ? 'selected' : '' }}>Terminal</option>
                    <option {{ $horario->tipo == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option {{ $horario->tipo == 'Especial' ? 'selected' : '' }}>Especial</option>
                </select>
            </div>
            <button type="submit" style="background:#0D47A1; color:white; padding:12px; border:none; border-radius:8px; font-weight:bold; cursor:pointer;">Actualizar Horario</button>
        </form>
    </div>
    <br><a href="{{ route('admin.horarios.index') }}" style="color:#0D47A1;">← Volver a horarios</a>
</div>
@endsection
