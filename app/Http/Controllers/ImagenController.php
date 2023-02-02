<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        
        //Arreglo con todo lo que lleva el request
        $imagen=$request->file('file');

        //Generamos un nombre unico para cada imagen
        $nombreImagen=Str::uuid().".".$imagen->extension();

        //Creamos la imagen que se almacena en el servidor
        $imagenServidor=Image::make($imagen);

        $imagenServidor->fit(1000,1000);

        //Creamos el path de la imagen
        $imagenPath=public_path('uploads').'/'.$nombreImagen;

        //Guardamos la imagen en el servidor con el path 
        $imagenServidor->save($imagenPath);

        //Respuesta mediante json
        return response()->json(['imagen'=>$nombreImagen]);
    }
}
