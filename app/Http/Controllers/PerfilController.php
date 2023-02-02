<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct(){
        $this->middleware('auth');    
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'=>Str::slug($request->username)]);
        
        $this->validate($request,[
            'username'=>'required|unique:users,username,'.auth()->user()->id.'|min:3|max:30|not_in:editar-perfil'
        ]);
        
        if($request->imagen){
                //Arreglo con todo lo que lleva el request
            $imagen=$request->file('imagen');
            
            //Generamos un nombre unico para cada imagen
            $nombreImagen=Str::uuid().".".$imagen->extension();

            //Creamos la imagen que se almacena en el servidor
            $imagenServidor=Image::make($imagen);

            $imagenServidor->fit(1000,1000);

            //Creamos el path de la imagen
            $imagenPath=public_path('perfiles').'/'.$nombreImagen;

            //Guardamos la imagen en el servidor con el path 
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario=User::find(auth()->user()->id);

        $usuario->username=$request->username;
        $usuario->imagen= $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index',$usuario->username);
    }
}
