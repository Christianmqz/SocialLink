<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Se agrega un arreglo con la información que el servidor espera recibir en el Request POST
    protected $fillable =[
        'titulo', 
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Relación belongsTo
    public function user() {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
}
