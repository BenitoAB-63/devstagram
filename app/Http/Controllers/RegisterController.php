<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{
    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        //dd($request->get('username'));

        //Modificar Request
        $request->request->add(['username'=>Str::slug($request->username)]);//slug sustituye espacios por un -

        //Validación
        $this->validate($request, [
            'name' => 'required|max:30',//tambien como arreglo ['required','min:5']
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed' //Confirmed para que valide el password_confirmation

        ]);

        //Crear

        User::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //Autenticar el usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Otra forma de autenticar

        //auth()->attempt($request->only('email','password'));

        //Redireccionar
        return redirect()->route('post.index');
    }
}
