<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nombre' => ['required'],
            'correo' => ['required', 'email'],
            'contraseña' => ['required']
        ]);

        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->contraseña], $request->remember)) {
            return redirect()->route('entertainment.index');
        }

        return back()->withErrors(['correo' => 'Las credenciales no coinciden.'])->withInput();
    }
}
