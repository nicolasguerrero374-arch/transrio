@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; padding:30px 15px;">
    <div style="background:white; width:100%; max-width:450px; border-radius:12px; box-shadow:0 8px 25px rgba(0,0,0,0.12); border:1px solid #e9ecef; overflow:hidden;">

        <div style="padding:30px 25px 20px 25px; text-align:center; border-bottom:1px solid #f1f1f1;">
            <div style="width:80px; height:80px; background:#0d47a1; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px auto; color:white; font-size:32px; font-weight:700;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 style="margin:0; font-size:22px; font-weight:700; color:#212529;">{{ $user->name }}</h2>
            <p style="color:#6c757d; font-size:14px; margin-top:5px;">{{ $user->email }}</p>
            <span style="display:inline-block; margin-top:10px; background:#e7f1ff; color:#0d6efd; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div style="padding:25px;">
            <div style="margin-bottom:16px; display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px solid #f8f9fa;">
                <span style="color:#6c757d; font-size:14px;">Nombre</span>
                <span style="font-weight:600; font-size:14px;">{{ $user->name }}</span>
            </div>
            <div style="margin-bottom:16px; display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px solid #f8f9fa;">
                <span style="color:#6c757d; font-size:14px;">Correo</span>
                <span style="font-weight:600; font-size:14px;">{{ $user->email }}</span>
            </div>
            <div style="margin-bottom:24px; display:flex; justify-content:space-between; padding:12px 0;">
                <span style="color:#6c757d; font-size:14px;">Cuenta creada</span>
                <span style="font-weight:600; font-size:14px;">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>

            <a href="/" style="display:block; text-align:center; background:#0d47a1; color:white; padding:12px; border-radius:8px; text-decoration:none; font-weight:600; margin-bottom:12px;">
                Ir al mapa
            </a>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" style="width:100%; background:white; color:#dc3545; border:1px solid #dc3545; padding:11px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
