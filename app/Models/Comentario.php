<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'post_id',
        'comentario'
    ];

    //Relacionamos Los comentarios con el usuario que los escribio para mostrarlo en vista
    public function user(){
        return $this->belongsTo(User::class);
    }
}
