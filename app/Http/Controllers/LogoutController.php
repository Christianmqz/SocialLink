<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store() {
        // logout() es un método en Laravel que termina con la sesión del usuario
        auth()->logout();

        // Redirecciona al usuario a la vista 'Login'
        return redirect()->route('login');
    }
}
