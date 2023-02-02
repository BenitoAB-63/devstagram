@extends('layouts.app')


@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-between md:items-center md:gap-4">
        <div class="my-0 mx-auto  w-5/6 md:w-11/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen Registro de Usuarios">
        </div>

        <div class="my-0 mx-auto  w-4/5 bg-white p-6 rounded-lg shadow-xl shadow-black">

            {{-- formulario --}}
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold"> Nombre </label>

                    <input type="text" id="name" name="name" placeholder="Tu nombre" value="{{old('name')}}" class="border p-3 w-full rounded-lg @error('name') border-red-500" >
                     
                        
                </div>
                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                @enderror
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold ">Nombre de Usuario </label>

                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" value="{{old('username')}}" class="border p-3 w-full rounded-lg @error('username') border-red-500" >
                </div>

                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                    @enderror

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold "> E-mail </label>

                    <input type="mail" id="email" name="email" placeholder="Tu e-mail" value="{{old('email')}}" class="border p-3 w-full rounded-lg @error('email') border-red-500" >

                    
                </div>
                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                    @enderror

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Contraseña </label>

                    <input type="password" id="password" name="password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500">
                </div>

                <p class="bg-red-500 text-center text-white rounded-lg text-sm p-2 mt-2">{{ $message }}</p>
                    @enderror

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar Contraseña </label>

                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
            {{-- fin de formulario --}}

        </div>
    </div>
@endsection