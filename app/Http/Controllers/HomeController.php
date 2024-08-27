<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke() {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Obtener a quienes seguimos con nuestra cuenta
        // pluck() retorna solo ciertos campos del arreglo, 'id' en este caso
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        // whereIn() filtra por ciertos valores de un arreglo en una columna
        
        return view('home', [
            'posts' => $posts
        ]);
    }

    // Op. 2 para proteger el controlador y la ruta, utilizando un 'middleware'
    // public function __construct() {
    //     $this->middleware('auth')->except(['show', 'index']);
    // }
}