<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

//importamos el modelo Comentario:
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request) {
        //validación. el mensaje es requerido en el formulario:
        $validate = $this->validate($request, [
            'body' => 'required'
        ]);
        //nueva variable del tipo objeto Comment:
        $comment = new Comment();
        //variable para el usuario logeado:
        $user = \Auth::user();
        //la id será la del usuario loggeado:
        $comment->user_id = $user->id;
        //la id del video llega desde el formulario por post:
        $comment->video_id = $request->input('video_id');
        $comment->body = $request->input('body');
        //guardar el comentario en la base de datos:
        $comment->save();
        //redirección para devolver una página:
        return redirect()->route('detailVideo', ['video_id' =>$comment->video_id]) -> with (array ('message' => 'Comentario guardado correctamente' ));
    }

    public function delete($comment_id) {
        //guardar el usuario identificado
        $user = \Auth::user();
        //comentario a borrar:
        $comment = Comment::find($comment_id);
    
        //si el usuario es el autor o es el que ha subido el vídeo:
        if ($user && ($comment->user_id == $user->id || $comment->video->user_id == $user->id)) {
            $comment->delete();
        }
        //redirección para devolver una página:
        return redirect()->route('detailVideo', ['video_id' =>$comment->video_id]) -> with (array ('message' => 'Comentario eliminado' ));
    
    }
    
}
