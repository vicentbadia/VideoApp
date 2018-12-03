<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Para utilizar el modelo de datos Video:
//Use App\Video;

Route::get('/', function () {

    /*
	$videos = Video::all();
	foreach ($videos as $video) {
		//var_dump($video);
        echo $video->title.'<br>';
        echo $video->user->email.'<br>';
        foreach ($video->comments as $comment) {
            echo $comment->body;
        }
    }
    */
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//rutas del controlador de Videos:

Route::get('/lista-videos', array(
	'as' => 'listaVideos',
	'middleware' => 'auth',  //utilizamos este middleware para comprobar la autenticación
	'uses' => 'VideoController@index'   //controlador y método a utilizar
));

Route::get('/crear-video', array(
	'as' => 'createVideo',
	'middleware' => 'auth',  //utilizamos este middleware para comprobar la autenticación
	'uses' => 'VideoController@createVideo'   //controlador y método a utilizar
));

//método post para enviar el formulario:
Route::post('/guardar-video', array(
	'as' => 'saveVideo',
	'middleware' => 'auth',  //utilizamos este middleware para comprobar la autenticación
	'uses' => 'VideoController@saveVideo'   //controlador y método a utilizar
));

//ruta para la miniatura del video:
Route::get('/miniatura/{filename}', array(
	'as' => 'imageVideo',
	'uses' => 'VideoController@getImage'
));

//ruta para la pagina de cada video:
Route::get('/video/{video_id}', array(
	'as' => 'detailVideo',
	'uses' => 'VideoController@getVideoPage'
));

//ruta para reproducir el vídeo:
Route::get('/video-file/{filename}', array (
	'as' => 'fileVideo',
	'uses' => 'VideoController@getVideo'
));

// Ruta guardar Comentarios:
Route::post('/comment', array(
	'as' => 'comment',
	//autenticación de usuario:
	'middleware' => 'auth',
	'uses' => 'CommentController@store'
));

// Ruta eliminar Comentarios:
Route::get('/delete-comment/{comment_id}', array(
	'as' => 'commentDelete',
	//autenticación de usuario:
	'middleware' => 'auth',
	'uses' => 'CommentController@delete'
));

// Ruta para borrar Videos:
Route::get('/delete-video/{video_id}', array(
	'as' => 'videoDelete',
	'middleware' => 'auth',
	'uses' => 'VideoController@delete'
));



//RUTAS CONTROLADOR DE EVENTOS

//Listado de eventos:
Route::get('/lista-eventos', array(
	'as' => 'listaEventos',
	'uses' => 'EventController@index'   //controlador y método a utilizar
));

//Crear nuevos eventos:
Route::get('/crear-eventos', array(
	'as' => 'crearEventos',
	'middleware' => 'auth',
	'uses' => 'EventController@crearEvento'   //controlador y método a utilizar
));

//método post para enviar el evento a guardar:
	Route::post('/guardar-evento', array(
		'as' => 'guardarEvento',
		'middleware' => 'auth',  //utilizamos este middleware para comprobar la autenticación
		'uses' => 'EventController@saveEvent'   //controlador y método a utilizar
	));

// Ruta para borrar Eventos:
Route::get('/delete-event/{event_id}', array(
	'as' => 'eventDelete',
	'middleware' => 'auth',
	'uses' => 'EventController@delete'
));


//método post para enviar el evento y cambiar el estado Cue / Play /Stop:
Route::post('/cambiar-evento', array(
	'as' => 'cambiarEvento',
	'middleware' => 'auth',  //utilizamos este middleware para comprobar la autenticación
	'uses' => 'EventController@cambiarEstado'   //controlador y método a utilizar
));

