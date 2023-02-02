<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Si no realiza correctamente el intento de autenticación nos retorna un error en la misma página. 
        //Lo hilamos con un @if(sesssion('mensaje')) para mostrar el mensaje. 
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('mensaje','Credenciales Incorrectas');
        };


        return redirect()->route('posts.index',auth()->user()->username);

        
    }
}
