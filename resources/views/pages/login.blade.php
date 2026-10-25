@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; padding: 30px 15px;">
    <div style="background:white; width:100%; max-width:400px; border-radius:12px; box-shadow:0 8px 25px rgba(0,0,0,0.12); border: 1px solid #e9ecef; overflow:hidden;">

        <div style="padding:30px 25px 10px 25px; text-align:center;">
            <div style="width:60px; height:60px; background:#e7f1ff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px auto;">
                <i class="bi bi-person" style="color:#0d6efd; font-size:30px;"></i>
            </div>
            <h2 style="margin:0; font-size:22px; font-weight:700; color:#212529;">Bienvenido a TransRío</h2>
            <p style="color:#6c757d; font-size:14px; margin-top:5px;">Ingresa a tu cuenta</p>
        </div>

        <div style="padding:15px 25px 25px 25px;">
            @if($errors->any())
            <div style="background:#f8d7da; color:#842029; padding:10px; border-radius:8px; margin-bottom:15px; font-size:13px;">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="font-size:13px; font-weight:600; color:#495057;">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        style="width:100%; padding:11px 12px; margin-top:6px; border:1px solid #ced4da; border-radius:8px; background:#f8f9fa; outline:none;"
                        placeholder="tu@correo.com">
                </div>
                <div style="margin-bottom:20px;">
                    <label style="font-size:13px; font-weight:600; color:#495057;">Contraseña</label>
                    <input type="password" name="password" required
                        style="width:100%; padding:11px 12px; margin-top:6px; border:1px solid #ced4da; border-radius:8px; background:#f8f9fa; outline:none;"
                        placeholder="••••••••">
                </div>
                <button type="submit" style="width:100%; background:#0d47a1; color:white; border:none; padding:12px; border-radius:8px; font-weight:600; cursor:pointer; font-size:15px;">
                    Ingresar
                </button>
            </form>

            <p style="text-align:center; margin-top:22px; font-size:14px; color:#495057;">
                ¿No tienes cuenta? <a href="/register" style="color:#0d6efd; text-decoration:none; font-weight:700;">Regístrate</a>
            </p>
            <p style="text-align:center; margin-top:12px; font-size:13px;">
                <a href="/" style="color:#6c757d; text-decoration:none;">← Volver al mapa sin cuenta</a>
            </p>
        </div>
    </div>
</div>
@endsection
