<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){
        //Validacion
        $this->validate($request,[
            'comentario'=>'required|max:255'
        ]);

        //Almacenar el resultado
        Comentario::create([
            //$user no nos sirve ya que solo es para mostrar username en la URL, solo lo ponemos en el controller para que no nos de fallo
            'user_id'=> auth()->user()->id,
            'post_id'=> $post->id,
            'comentario'=> $request->comentario
        ]);

        //Imprimir mensaje
        return back()->with('mensaje','Comentario Publicado Correctamente');
    }
}
