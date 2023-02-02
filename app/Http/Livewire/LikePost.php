<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likes;

    //Mount hace de constructor, solo se ejecuta al principio de instanciarse livewire. Por este motivo isliked tendra que ser sobreescrito en like()
    public function mount($post)
    {
        //isLiked tendra un 1 o nada dependiendo de si el usuario ya dio like previamente o no
        $this->isLiked=$post->checkLike(auth()->user());
        $this->likes=$post->likes->count();
    }

    public function like()
    {
        //Si el usuario autenticado ya dio like(Post.php) eliminamos el like
       if($this->post->checkLike(auth()->user())){
            //Como tenemos la relacion hasMany en Post.php podemos acceder a los likes desde $post
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            //Sobreescribimos isLiked
            $this->isLiked = false;
            $this->likes--;
            return back();
       }else{
            $this->post->likes()->create([
                'user_id'=> auth()->user()->id
            ]);
            //Sobreescribimos isLiked
            $this->isLiked=true;
            $this->likes++;
            return back();
       }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
