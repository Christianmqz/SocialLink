<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    public function store(User $user) {
        // User $user - contiene el id del perfil visitado, no necesariamente autenticado
        
        $user->followers()->attach( auth()->user()->id ); // attach es útil en relaciones de muchos a muchos 

        return back();
    }

    public function destroy(User $user) {
        $user->followers()->detach( auth()->user()->id ); // detach es lo contrario de attach
        return back();
    }
}
