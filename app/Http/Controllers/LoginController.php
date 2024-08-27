<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Autenticar al Usuario
        // Si la negación de la expresión se cumple, imprime el mensaje de error 
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
        // back() es una función de Laravel que redirecciona al usuario hacia la página anterior
        // with() crea una variable de session llamada 'mensaje' con el valor 'Credenciales Incorrectas'
    
        // Una vez autenticado, se redirecciona al usuario a su muro
        return redirect()->route('posts.index', auth()->user()->username);
        // auth()->user()->username obtiene el nombre de usuario del usuario autenticado
    }
}
