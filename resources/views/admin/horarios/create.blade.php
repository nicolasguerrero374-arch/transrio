@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:600px; margin:auto;">
    <h2 style="margin-bottom:20px;">Nuevo Horario</h2>

    <div style="background:white; padding:25px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('admin.horarios.store') }}" style="display:grid; gap:15px;">
            @csrf

            <div>
                <label>Ruta</label>
                <select name="ruta_id" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    @foreach($rutas as $ruta)
                    <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Parada</label>
                <select name="parada_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    <option value="">-- Sin parada --</option>
                    @foreach($paradas as $parada)
                    <option value="{{ $parada->id }}">{{ $parada->nombre ?? $parada->direccion ?? 'Parada '.$parada->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Hora Apertura</label>
                <input type="time" name="hora_apertura" required value="05:00" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label>Hora Cierre</label>
                <input type="time" name="hora_cierre" required value="20:00" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label>Hora Salida</label>
                <input type="time" name="hora_salida" value="05:00" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label>Días</label>
                <input type="text" name="dias" required value="Lunes a Viernes" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label>Tipo</label>
                <select name="tipo" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
                    <option>Terminal</option>
                    <option>Intermedio</option>
                    <option>Especial</option>
                </select>
            </div>

            <button type="submit" style="background:#0D47A1; color:white; padding:12px; border:none; border-radius:8px; font-weight:bold; cursor:pointer;">
                Guardar Horario
            </button>
        </form>
        <br>
        <a href="{{ route('admin.horarios.index') }}" style="color:#0D47A1;">← Volver a horarios</a>
    </div>
</div>
@endsection
