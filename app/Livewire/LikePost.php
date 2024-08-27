<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Atributo = Variable en una clase
    // Representa el post que es gustado / no gustado
    public $post;

    public $isLiked;
    public $likes;

    // mount establece el estado inicial de 'isLiked' al cargar por primera vez
    public function mount($post) {
        // Guarda true / false al comprobar si el usuario ya ha dado o no like
        $this->isLiked = $post->checkLike( auth()->user() );
        $this->likes = $post->likes->count();
    }

    public function like() 
    {
        // Verifica si el usuario autenticado ya ha dado like al 'post'
        if($this->post->checkLike( auth()->user() )) {
            // Si ya le ha dado like, elimina el like de la DB
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            // Si aún no le ha dado like, añade un like a la DB
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);

            $this->isLiked = true;
            $this->likes++;
        }
    }

    // Renderiza la vista Blade asociada
    public function render()
    {
        return view('livewire.like-post');
    }
}
