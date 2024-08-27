<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

class PostController extends Controller
{
    // Op. 2 para proteger el controlador y la ruta, utilizando un 'middleware'
    // public function __construct() {
    //     $this->middleware('auth')->except(['show', 'index']);
    // }

    public function index(User $user) {
        // auth->user() contiene datos importantes para la autenticación de usuarios 

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Modelo de Eloquent que filtra las publicaciones de cada usuario de la tabla de Posts
        $posts = Post::where('user_id', $user->id)
                        ->latest()
                        ->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() {
        return view('posts.create');
    }

    // Las validaciones de Request siempre debe ir en store
    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Crea el registro por medio de Laravel en la tabla donde se almacena la DB
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // Otra forma de crear el registro
        /*  $post = new Post;
            $post->titulo = $request->titulo;
            $post->descripcion = $request->descripcion;
            $post->imagen = $request->imagen;
            $post->user_id = auth()->user()->id;
            $post->save();  
        */

        // Forma más convencional en laravel de crear el registro
        /*  $request->user()->posts()->create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'user_id' => auth()->user()->id
            ]);
        */

        // Redirecciona al usuario a su muro 
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post) {

        if (Auth::check() && Auth::user()->id === $post->user_id) {
            $post->delete();
        }

        // Eliminar la imagen
        $imagen_path = public_path('build/uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
