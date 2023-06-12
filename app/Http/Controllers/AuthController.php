<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function login()
    {
        session(['showLoginButton' => false]);
        return view('auth/login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $user = DB::table('users')->where('email', $request->email)->first();

            if ($user->activo == false) {
                auth()->logout();
                return back()->with('error', 'El usuario no está activo.');
            }

            $perfil_id = DB::table('users')->where('email', $request->email)->value('perfil_id');
            $perfil = DB::table('perfiles')->where('id', $perfil_id)->value('perfil');
            session(['perfil' => $perfil]);
            return redirect('/gestion-usuarios')->with('success', 'Logueado correctamente.');
        }

        return back()->with('error', 'Las credenciales no son correctas.');
    }

    public function register()
    {
        $showLoginButton = false;
        return view('auth/register', compact('showLoginButton'));
    }

    public function registerPost(Request $request)
    {
        $user = new User();

        $user->nombre = $request->name;
        $user->apellidos = $request->surnames;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->perfil_id = 1;
        $user->activo = true;

        $user->save();

        return back()->with('success', 'Register successfully.');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
