<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected  $table = "events";   //esto enlaza el modelo con la tabla

    //Relación Many to One
    //Esto creará un objeto con la información del Estado de cada Evento
    public function estado() {
	    return $this->belongsTo('App\Status', 'status');
    }
}