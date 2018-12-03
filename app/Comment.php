<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    //Relación Many to One
    //Esto creará un objeto con toda la información del usuario de cada comentario
    public function user() {
	    return $this->belongsTo('App\User', 'user_id');
    }

    //objeto con la información del vídeo donde está el comentario:
    public function video() {
        return $this->belongsTo('App\Video', 'video_id');
    }

}
