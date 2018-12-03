<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected  $table = "videos";   //esto enlaza el modelo con la tabla

    //relación One to Many - Uno a Muchos
    //esto relaciona cada video con todos sus comentarios:
    public function comments() {
	    return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //Relación Many to One
    //Esto creará un objeto con toda la información del usuario de cada video
    public function user() {
	    return $this->belongsTo('App\User', 'user_id');
    }
}
