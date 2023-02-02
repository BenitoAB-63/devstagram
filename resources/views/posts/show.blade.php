@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
    <div class="container mx-auto  flex flex-col md:flex-row">

        <div class="md:w-1/2">
            <img src="{{asset('uploads').'/'.$post->imagen}}" alt="Imagen del post {{$post->titulo}}">

            <div class="p-3 flex items-center gap-4">
                @auth


                <livewire:like-post :post="$post" />

                @endauth
               
                
            </div>

            <div>
                {{-- podemos acceder al usuario gracias al belongTo en el modelo de Post y la relacion con el foreingId de user --}}
                <p class="font-bold">{{$post->user->username}}</p>
                <p class="text-sm text-gray-500">
                    {{-- con la Extension de API Carbon integrada en laravel convertimos las fechas en cantidad de dias --}}
                    {{$post->created_at->diffForHumans()}}
                </p>

                <p class="mt-5">
                    {{$post->descripcion}}
                </p>

                
            </div>
            @auth
                {{-- Controlamos que el usuario autenticado es el creador del post para que pueda eliminarlo --}}
                @if($post->user_id===auth()->user()->id)
                    <form method="POST" action="{{route('posts.destroy',$post)}}">
                        {{-- Metodo spoofin --}}
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>

        {{-- Caja de comentarios --}}
        <div class="md:w-1/2 p-5">
            
            <div class="shadow shadow-gray-600 bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo Comentario</p>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif
                
                    <form action="{{route('comentarios.store',['post'=>$post, 'user'=>$user])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold"> Comentario </label>
        
                            <textarea id="comentario" name="comentario" class="border p-3 w-full rounded-lg overflow-y-hidden @error('comentario') border-red-500 @enderror" >
                                {{old('comentario')}}

                            </textarea>

                            @error('comentario')
                            <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                            @enderror
                                
                        </div>

                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>

                @endauth

                <p class="text-xl font-bold text-center my-4">Comentarios</p>

                <div class="bg-white shadow shadow-gray-600 my-5 max-h-96 overflow-y-hidden">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route('posts.index',$comentario->user)}}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>

                            
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún</p>
                    @endif
                </div>

                
            </div>
            
        </div>
        
    </div>
@endsection