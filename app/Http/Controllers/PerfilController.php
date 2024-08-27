<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function index() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('perfil.index');
    }

    // Op. 2 para proteger el controlador y la ruta, utilizando un 'middleware'
    // public function __construct() {
    //     $this->middleware('auth')->except(['show', 'index']);
    // }

    public function store(Request $request) {
        // Modificar el request - para que aparezca el mensaje de validación en caso de registros duplicados
        $request->merge(['username' => Str::slug($request->username)]);

        // Validación
        $request->validate([
            'username' => [
                'required',
                'unique:users,username,' . auth()->id(), // Ensure this checks uniqueness against other users except the current user
                'min:3',
                'max:20',
                'not_in:admin,administrator,root,system,support,moderator,superuser,owner,help,guest,webmaster,null,undefined,test,anonymous,user,username,default,rules,password,temp,info,contact,staff,official,security,privacy,terms,policy,whatsapp,legal,google,facebook,twitter,apple,microsoft,youtube,linkedin,instagram,paypal'
            ],
            'email' => 'unique:users|email|max:60',
            'password' => 'confirmed',
        ]);

        if($request->imagen) {
            $imagen = $request->file('imagen');

            // Str::uuid() genera un token id unico para diferenciar las imagenes subidas en la DB
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Crea la imagen para poder usar Intervention Image
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('build/perfiles') . "/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar Cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->email = $request->email;
        $usuario->password = Hash::make( $request->password );
        $usuario->save();
        
        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
