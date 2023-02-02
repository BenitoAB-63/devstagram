<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        //Como estamos relacionando con la misma tabla follower_id,users_id->users utilizaremos attach en vez de create
        $user->followers()->attach(auth()->user()->id); //La persona autenticada es la que esta dandole a SEGUIR

        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id); //La persona autenticada es la que esta dandole a SEGUIR

        return back();
    }
}
