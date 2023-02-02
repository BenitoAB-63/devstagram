<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(){
        //Para acceder a cualquier metodo de este controlado rel usuario debe estar autenticado.
        $this->middleware('auth')->except(['show', 'index']);    
    }

    //$user obtendra el usuario cuyo username haya en la url
    public function index(User $user){



        //Obtenemos los resultados del siguiente where con get()
        $posts=Post::where('user_id',$user->id)->latest()->paginate(20);

        return view('dashboard',[
            'user'=>$user,
            'posts'=>$posts
        ]);
    }

    //Enviamos al formulario de la publicacion
    public function create(){
        return view('posts.create');
    }

    //Validamos y almacenamos los datos de la publicacion
    public function store(Request $request){
        $this->validate($request,[
            'titulo'=>'required|max:255',
            'descripcion'=>'required',
            'imagen'=>'required'
        ]);

        // Post::create([
        //     'titulo'=>$request->titulo,
        //     'descripcion'=>$request->descripcion,
        //     'imagen'=>$request->imagen,
        //     'user_id'=> auth()->user()->id

        // ]);

        //Otras formas de añadir registros en la BBDD

        // $post=new Post;
        // $post->titulo=$request->titulo;
        // $post->descripcion=$request->descripcion;
        // $post->imagen=$request->imagen;
        // $post->user_id=auth()->user()->id;
        // $post->save();

        //Creando un registro en la relacion hasMany posts()
        $request->user()->posts()->create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            'user_id'=> auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user,Post $post){

        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        //Si nos devuelve true la autorizacion-->Policy, eliminamos el post
        $post->delete();

        //Eliminamos tambien la imagen
        $imagen_path=public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index',auth()->user()->username);
    }


}
