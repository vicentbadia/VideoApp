<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected  $table = "status";   //esto enlaza el modelo con la tabla

    //relación One to Many - Uno a Muchos
    //esto relaciona cada Estado con todos los Eventos que se encuentran en ese estado:
    public function eventos() {
	    return $this->hasMany('App\Event')->orderBy('status','asc');
    }

}