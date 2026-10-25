@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:1000px; margin:auto;">
    <h2 style="margin-bottom:20px;">Horarios</h2>

    <a href="{{ route('admin.horarios.create') }}" style="background:#2E7D32;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin-bottom:20px;">+ Nuevo Horario</a>

    <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#0D47A1; color:white;">
                <tr>
                    <th style="padding:12px; text-align:left;">Parada</th>
                    <th style="padding:12px; text-align:left;">Ruta</th>
                    <th style="padding:12px; text-align:left;">Hora</th>
                    <th style="padding:12px; text-align:left;">Días</th>
                    <th style="padding:12px; text-align:left;">Tipo</th>
                    <th style="padding:12px; text-align:center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($horarios as $h)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">{{ $h->parada->nombre ?? 'Sin parada' }}</td>
                    <td style="padding:12px;">{{ $h->ruta->nombre ?? 'Sin ruta' }}</td>
                    <td style="padding:12px;">{{ $h->hora_salida }}</td>
                    <td style="padding:12px;">{{ $h->dias }}</td>
                    <td style="padding:12px;">{{ $h->tipo }}</td>
                    <td style="padding:12px; text-align:center; display:flex; gap:6px; justify-content:center;">
                        <a href="{{ route('admin.horarios.edit', $h) }}" style="background:#0288D1; color:white; padding:6px 12px; border-radius:6px; text-decoration:none;">Editar</a>

                        <form method="POST" action="{{ route('admin.horarios.destroy', $h) }}" onsubmit="return confirm('¿Borrar este horario?')">
                            @csrf @method('DELETE')
                            <button style="background:#D32F2F;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:20px; text-align:center; color:#777;">No hay horarios aún</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <br>
    <a href="{{ route('admin.dashboard') }}" style="color:#0D47A1;">← Volver al panel</a>
</div>
@endsection
