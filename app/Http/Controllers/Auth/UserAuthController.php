<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && $user->role === 'conductor' && !$user->is_approved) {
        return back()->withErrors(['email' => 'Tu cuenta de conductor está pendiente de aprobación por un administrador.']);
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Correo o contraseña incorrectos']);
}
    public function showRegister()
    {
        return view('pages.register');
    }
   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:user,conductor',
    ]);

    $isApproved = $request->role === 'conductor' ? false : true;

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'is_approved' => $isApproved,
    ]);

    Auth::login($user);

    return redirect('/');
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
    public function perfil()
    {
        return view('pages.perfil', ['user' => Auth::user()]);
    }
}
