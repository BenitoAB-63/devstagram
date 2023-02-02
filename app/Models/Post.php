<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Cada post pertenece a un usuario --> Relacion belongs to
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    //Cada post tiene muchos comentarios -->relacion Has many
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    //Relacion has many ya que un post puede recibir muchos likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Comprobamos si el usuario habia dado like previamente
    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id); 
    }
}
