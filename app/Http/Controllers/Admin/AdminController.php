<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['Credenciales incorrectas'])->withInput();
        }

        if (!in_array($user->role, ['super_admin', 'admin'])) {
            return back()->withErrors(['No tienes permiso'])->withInput();
        }

        session([
            'admin_id' => $user->id,
            'admin_name' => $user->name,
            'admin_role' => $user->role
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.dashboard');
    }
    public function usuarios()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        if (session('admin_role') !== 'super_admin') {
            abort(403, 'Solo Super Admin puede gestionar usuarios');
        }
        $usuarios = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function updateRole(Request $request, $id)
    {
        if (!session()->has('admin_id') || session('admin_role') !== 'super_admin') {
            abort(403);
        }
        $user = \App\Models\User::findOrFail($id);

        if ($user->id == session('admin_id')) {
            return back()->withErrors(['No puedes cambiar tu propio rol']);
        }

        $request->validate([
            'role' => 'required|in:user,conductor,admin,super_admin'
        ]);

        $user->role = $request->role;

        // Si lo pones como conductor, lo aprobamos automáticamente
        if ($request->role === 'conductor') {
            $user->is_approved = true;
        }

        $user->save();

        return back()->with('success', 'Rol actualizado correctamente');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name', 'admin_role']);
        return redirect()->route('admin.login');
    }
}
