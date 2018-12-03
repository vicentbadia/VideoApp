<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
//importar los modelos a utilizar:
use App\Event;
use App\Status;

class EventController extends Controller
{
    public function index()
    {
        $eventos = Event::orderBy('eventID','asc')->paginate(5);

        return view('eventos.lista',array (
            'eventos'=>$eventos
        ));
    }


    public function crearEvento() {
        return view('eventos.create');
    }


    //Guardar Evento:
    public function saveEvent(Request $request) {
        //validar formulario
        $validatedData = $this->validate($request, [
            'id' => 'required|max:8',  //maximo 8 caracteres
            'title' => 'required',
        ]);

        $requestData = $request->all();

        $evento = new Event();
        //necesitamos el usuario para guardarlo en la base de datos:
        $user = \Auth::user();
        //asignamos los campos al objeto Evento:
        $evento->eventID=$requestData['id'];
        $evento->title=$requestData['title'];
        $evento->status = 3;  //Estado por defecto: Stop
        $evento->user_id = $user->id;

        //el ORM Eloquent guarda el objeto en la base de datos:
        $evento->save();

        return redirect()->route('crearEventos')->with(array(
	        'message' => 'Evento guardado correctamente.'
        ));

    }

    //Borrar Evento:
    public function delete($event_id) {
        //usuario identificado:
        $user = \Auth::user();
        //Seleccionar evento a eliminar por su Id:
        //ModelName::where('name_id', $id)->get();
        //ModelName::where('slug', '=', $slug)->first();
        $evento = Event::where('eventID', $event_id)->first();
    
        //si hay un usuario identificado y es el autor del Evento o es administrador:
        if ($user && ($evento->user_id == $user->id || $user->role == 'Admin')) {

            //borrar el video
            //esta no funciona porque toma por defecto el campo id y en la tabla de eventos se llama eventID:
            //$evento->delete();
            $res=Event::where('eventID', $event_id)->delete();
    
            $message = array('message' => 'Evento eliminado correctamente');
        } else {
            $message = array('message' => 'Necesitas permisos de administrador para eliminar un evento');
        }
        return redirect()->route('listaEventos')->with($message);
    }


       //Cambiar el estado del evento:
       public function cambiarEstado(Request $request) {
  
        $requestData = $request->all();

        $evento = new Event();

        //asignamos los campos al objeto Evento:
        $evento->eventID=$requestData['optradio'];

        switch($request->submitbutton) {

            case 'Cue': 
                $evento->status = 1;
                $accion = "Cue";
            break;
        
            case 'Play': 
                $evento->status = 2;
                $accion = "Play";
            break;

            case 'Stop': 
                $evento->status = 3;
                $accion = "Stop";
            break;
        }

        //Modificamos el Evento en la base de datos:
        //find no funciona porque el campo clave primaria se llama eventID y no id
        Event::where('eventID', $evento->eventID)->update(['status' => $evento->status]);

        return redirect()->route('listaEventos')->with(array(
	        'message' => 'Evento '.$evento->eventID.' modificado: '.$accion
        ));

    }

}
