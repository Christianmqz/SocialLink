<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request) {
        $imagen = $request->file('file');

        // Str::uuid() genera un token id unico para diferenciar las imagenes subidas en la DB
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Crea la imagen para poder usar Intervention Image
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('build/uploads') . "/" . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
