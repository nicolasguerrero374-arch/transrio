@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:1000px; margin:auto;">
    <h2 style="margin-bottom:20px;">Tarifas</h2>
    <a href="{{ route('admin.tarifas.create') }}" style="background:#2E7D32;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin-bottom:20px;">+ Nueva Tarifa</a>
    <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#0D47A1; color:white;">
                <tr>
                    <th style="padding:12px; text-align:left;">Destino</th>
                    <th style="padding:12px; text-align:left;">Precio</th>
                    <th style="padding:12px; text-align:left;">Tipo</th>
                    <th style="padding:12px; text-align:center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifas as $t)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">{{ $t->destino }}</td>
                    <td style="padding:12px;">${{ number_format($t->precio, 0) }}</td>
                    <td style="padding:12px;">{{ $t->tipo }}</td>
                    <td style="padding:12px; text-align:center; display:flex; gap:6px; justify-content:center;">
                        <a href="{{ route('admin.tarifas.edit', $t) }}" style="background:#0288D1; color:white; padding:6px 12px; border-radius:6px; text-decoration:none;">Editar</a>

                        <form method="POST" action="{{ route('admin.tarifas.destroy', $t) }}" onsubmit="return confirm('¿Borrar tarifa a {{ $t->destino }}?')">
                            @csrf @method('DELETE')
                            <button style="background:#D32F2F;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:20px; text-align:center; color:#777;">No hay tarifas aún</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br><a href="{{ route('admin.dashboard') }}" style="color:#0D47A1;">← Volver al panel</a>
</div>
@endsection
