@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:1100px; margin:auto;">
    <h2 style="margin-bottom:20px;">Rutas</h2>
    <a href="{{ route('admin.rutas.create') }}" style="background:#2E7D32;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin-bottom:20px;">+ Nueva Ruta</a>

    <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1); overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#0D47A1; color:white;">
                <tr>
                    <th style="padding:12px; text-align:left;">Nombre</th>
                    <th style="padding:12px; text-align:left;">Placa</th>
                    <th style="padding:12px; text-align:left;">Color</th>
                    <th style="padding:12px; text-align:left;">Descripción</th>
                    <th style="padding:12px; text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rutas as $r)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">{{ $r->nombre }}</td>
                    <td style="padding:12px;">{{ $r->placa }}</td>
                    <td style="padding:12px;">{{ $r->color }}</td>
                    <td style="padding:12px;">{{ Str::limit($r->descripcion, 50) }}</td>
                    <td style="padding:12px; text-align:center; display:flex; gap:8px; justify-content:center;">
                        <a href="{{ route('admin.rutas.edit', $r) }}" style="background:#0288D1;color:white;padding:6px 12px;border-radius:6px;text-decoration:none;">Editar</a>
                        <form method="POST" action="{{ route('admin.rutas.destroy', $r) }}" onsubmit="return confirm('¿Seguro que quieres eliminar {{ $r->nombre }}?')">
                            @csrf @method('DELETE')
                            <button style="background:#D32F2F;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:20px; text-align:center; color:#777;">No hay rutas aún</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br>
    <a href="{{ route('admin.dashboard') }}" style="color:#0D47A1;">← Volver al panel</a>
</div>
@endsection
