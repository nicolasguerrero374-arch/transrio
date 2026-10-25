@extends('layouts.app')
@section('content')
<div style="padding:90px 20px 20px 20px; max-width:900px; margin:0 auto;">

    <h2 style="margin:15px 0; text-align:center;">👥 Gestión de Usuarios</h2>

    @if(session('success'))
    <div style="background:#d1e7dd; padding:10px; border-radius:8px; margin-bottom:15px; text-align:center;">{{ session('success') }}</div>
    @endif

    <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.08);">
        @foreach($usuarios as $u)
        <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 16px; border-bottom:1px solid #f1f1f1; flex-wrap:wrap; gap:10px;">
            <div>
                <div style="font-weight:600;">{{ $u->name }} @if($u->id == session('admin_id')) <span style="font-size:11px; color:#6c757d;">(TÚ)</span> @endif</div>
                <div style="font-size:13px; color:#6c757d;">{{ $u->email }}</div>
                <span style="font-size:11px; background:#e7f1ff; color:#0d6efd; padding:2px 8px; border-radius:10px;">{{ $u->role }}</span>
                @if($u->role == 'conductor' && !$u->is_approved) <span style="font-size:11px; background:#ffc107; color:#000; padding:2px 8px; border-radius:10px; font-weight:bold; margin-left:5px;">Pendiente por aprobar</span> @endif
            </div>
            <form method="POST" action="{{ route('admin.usuarios.updateRole', $u->id) }}" style="display:flex; gap:6px;">
                @csrf
                <select name="role" style="padding:6px 8px; border-radius:6px; border:1px solid #dee2e6;" @if($u->id == session('admin_id')) disabled @endif>
                    <option value="user" @if($u->role==='user') selected @endif>Usuario</option>
                    <option value="conductor" @if($u->role=='conductor') selected @endif>Conductor</option>
                    <option value="admin" @if($u->role==='admin') selected @endif>Admin</option>
                    <option value="super_admin" @if($u->role==='super_admin') selected @endif>Super Admin</option>
                </select>
                @if($u->id != session('admin_id'))
                <button style="background:#0d47a1; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">Guardar</button>
                @endif
            </form>

        </div>
        @endforeach
    </div>
    <div style="text-align:center; margin-top:25px;">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration:none; color:#0d47a1; font-weight:600; background:#e7f1ff; padding:10px 18px; border-radius:20px;">← Volver al panel</a>
    </div>
</div>

@endsection
