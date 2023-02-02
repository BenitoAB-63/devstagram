@extends('layouts.app')


@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-between md:items-center md:gap-4">
        <div class="my-0 mx-auto  w-5/6 md:w-11/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Login de Usuarios">
        </div>

        <div class="my-0 mx-auto  w-4/5 bg-white p-6 rounded-lg shadow-xl shadow-black">

            {{-- formulario --}}
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf

                @if(session('mensaje'))
                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold "> E-mail </label>

                    <input type="mail" id="email" name="email" placeholder="Tu e-mail" value="{{old('email')}}" class="border p-3 w-full rounded-lg @error('email') border-red-500" />

                    
                </div>
                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p> @enderror

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Contraseña </label>

                    <input
                     type="password"
                     id="password" 
                     name="password" 
                     placeholder="Tu Contraseña" 
                     class="border p-3 w-full rounded-lg @error('password') border-red-500  @enderror" />

                </div>

                @error('password')
                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                @enderror

                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm font-bold">Mantener mi sesión abierta</label> 
                </div>
                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />

            </form>
            {{-- fin de formulario --}}

        </div>
    </div>
@endsection