<div>


    @if($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    @foreach($posts as $post)

        <div class="">
            <a href="{{route('posts.show', ['post'=>$post, 'user'=>$post->user])}}">
                <img src="{{asset('uploads')."/".$post->imagen}}" alt="imagen del post {{$post->titulo}}">
            </a>
        </div>

    @endforeach

        </div>

            <div class="my-10">
                {{$posts->links()}}
            </div>
    @else
            <p class="text-center">No hay publicaciones</p>
    @endif

    {{-- Otra forma de poner lo anterior --}}
    {{-- @forelse ($posts as $post)
        <h1>{{$post->titulo}}</h1>
    @empty
        <p>No hay publicaciones</p>
    @endforelse --}}
</div>