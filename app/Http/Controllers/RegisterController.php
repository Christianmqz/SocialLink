<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 'Index' siempre para el controlador que muestra una vista
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        // dd($request); 
        // dd() dumb & die imprime el atributo ingresado pero detiene el código por completo

        // Modificar el Request - para que aparezca el mensaje de validación en caso de registros duplicados
        $request->request->add(['username' => Str::slug( $request->username)]);

        // Validación
        // Se valida cada campo del formulario según sus necesidades
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:6|confirmed',
        ]);

        // Equivalente a INSERT INTO en MySQL
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        // Str::lower() convierte el registro a minusculas
        // Str::slug() convierte el registro a una URL, sustituyendo los espacios por guiones(-)

        // Autenticar al Usuario
        auth()->attempt($request->only('email', 'password'));
        // only('email', 'password') extrae solamente los campos de 'email' & 'password' del request HTTP
        // attempt() autentica al usuario con sus credenciales proporcionadas
    
        // Redireccionar al Usuario
        return redirect()->route('login');
        // redirect() y route() son helpers que nos ayudan a redireccionar al usuario hacia una URL 
    }
}