@extends('layouts.app')
@section('content')
<div style="margin-top:80px;padding:20px">
    <h2>Panel Del Adminitrador TransRio</h2>
    <p>Bienvenido administrador</p>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:20px">

        <a href="{{ route('admin.paradas.index') }}" style="padding:20px;background:#0D47A1;color:white;text-decoration:none;border-radius:10px;text-align:center">📍 Paradas</a>

        <a href="{{ route('admin.rutas.index') }}" style="padding:20px;background:#0D47A1;color:white;text-decoration:none;border-radius:10px;text-align:center">🚌 Rutas (coordenadas)</a>

        <a href="{{ route('admin.horarios.index') }}" style="padding:20px;background:#0D47A1;color:white;text-decoration:none;border-radius:10px;text-align:center">🕒 Horarios</a>

        <a href="{{ route('admin.tarifas.index') }}" style="padding:20px;background:#0D47A1;color:white;text-decoration:none;border-radius:10px;text-align:center">💰 Tarifas</a>

        <a href="{{ route('admin.numeros.index') }}" style="padding:20px;background:#0D47A1;color:white;text-decoration:none;border-radius:10px;text-align:center">📞 Números</a>

        <a href="{{ route('admin.usuarios.index') }}" style="padding:20px;background:#0d47A1;color:white;text-decoration:none;border-radius:10px;text-align:center;">👥 Usuarios</a>

        <form method="POST" action="{{ route('admin.logout') }}">@csrf<button style="padding:20px;background:red;color:white;border:none;border-radius:10px;width:100%">Salir</button></form>
    </div>
</div>
@endsection
