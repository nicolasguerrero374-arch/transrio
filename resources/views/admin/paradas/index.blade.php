@extends('layouts.app')
@section('content')
<div style="padding:100px 20px 20px 20px; max-width:1100px; margin:auto;">
    <h2 style="margin-bottom:20px;">Paradas</h2>
    <a href="{{ route('admin.paradas.create') }}" style="background:#2E7D32;color:white;padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin-bottom:20px;">+ Nueva Parada</a>
    <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1); overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#0D47A1; color:white;">
                <tr>
                    <th style="padding:12px; text-align:left;">Nombre</th>
                    <th style="padding:12px; text-align:left;">Tipo</th>
                    <th style="padding:12px; text-align:left;">Lat / Lng</th>
                    <th style="padding:12px; text-align:left;">Foto</th>
                    <th style="padding:12px; text-align:center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paradas as $p)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">{{ $p->nombre }}</td>
                    <td style="padding:12px;">{{ $p->tipo }}</td>
                    <td style="padding:12px; font-size:12px;">{{ $p->lat }}, {{ $p->lng }}</td>
                    <td style="padding:12px;">
                        @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                        @else
                        <span style="color:#999;">Sin foto</span>
                        @endif
                    </td>
                    <td style="padding:12px; text-align:center; display:flex; gap:6px; justify-content:center;">
                        {{-- BOTON EDITAR NUEVO --}}
                        <a href="{{ route('admin.paradas.edit', $p) }}" style="background:#0288D1; color:white; padding:6px 12px; border-radius:6px; text-decoration:none;">Editar</a>

                        {{-- TU BOTON BORRAR QUE YA TIENES --}}
                        <form method="POST" action="{{ route('admin.paradas.destroy', $p) }}" onsubmit="return confirm('¿Seguro que quieres eliminar {{ $p->nombre }}?')">
                            @csrf @method('DELETE')
                            <button style="background:#D32F2F;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:20px; text-align:center; color:#777;">No hay paradas aún</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br><a href="{{ route('admin.dashboard') }}" style="color:#0D47A1;">← Volver al panel</a>
</div>
@endsection
