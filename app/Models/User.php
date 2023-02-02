<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Un usuario puede tener muchos posts-->Relacion one has many
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Almacenamos los seguidores del usuario
    public function followers(){
        //Como nos hemos salido de las convenciones de laravel tenemos que indicar los campos a rellenar y la tabla
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //Almacenamos los que seguimos
    public function follows(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //Comprobar si ya se sigue a un usuario
    public function following(User $user){
        return $this->followers->contains($user->id);//Le pasamos el id del usuario autenticado
    }

    

}
