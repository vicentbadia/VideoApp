@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-offset-1">
	<h2>Video Playlist</h2>
	<hr>
                     <!--listado de videos: -->
                     <div id="videos-list">
                            @foreach($videos as $video)
                                <div class="video-item col-sm-12 col-xs-12 pull-left panel panel-default">
                                    <div class="panel-body">
                                        <!-- imagen del video -->
                                        <!-- comprobamos primero si existe la imagen: -->
                                        @if (Storage::disk('images')->has($video->image))
                                        <div class="mini-video col-sm-4 col-xs-12 pull-left">
                                            <div class="video-image-mask">
                                            <img src="{{ url('/miniatura/'.$video->image) }}" alt="{{ $video->title }}"  class="video-image img-fluid" style="max-width:100%; height: auto;" />
                                            </div>
                                        </div>
                                        @endif
                                        <div class= "data col-sm-8 col-xs-12 pull-right">
                                            <h3><a href="{{ route('detailVideo', ['video_id' => $video->id]) }}" title="{{ $video->title }}">{{ $video->title }}</a></h3>
                                            <p>{{ $video->user->name.' '.$video->user->surname }}</p>
                                            <!-- BOTONES ACCIÓN -->
                                            <a href="{{ route('detailVideo', ['video_id' => $video->id]) }}" title="{{ $video->title }}" class="btn btn-success">Ver video</a>
                                            <!-- El botón Editar aparece si el usuario está identificado y es el autor del vídeo o es Administrador -->
                                            @if (Auth::check() && (Auth::user()->id == $video->user->id || Auth::user()->role == 'Admin'))
                                                <!-- BOTON EDITAR
                                                <a href="" class="btn btn-warning">Editar</a> -->

                                                <!--Boton Eliminar con ventana modal para pedir confirmación -->

                                                <a href="#victorModal{{$video->id}}" role="button" class="btn btn-sm btn-danger btnBorrar" data-toggle="modal">X</a>
  
                                                <!-- Modal / Ventana / Overlay en HTML -->
                                                <div id="victorModal{{$video->id}}" class="modal fade">
                                                    								<div class="modal-dialog">
                                                        								<div class="modal-content">
                                                            								<div class="modal-header">
                                                                								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                								<h4 class="modal-title">¿Estás seguro?</h4>
                                                            								</div>
                                                            								<div class="modal-body">
                                                                								<p>¿Seguro que quieres borrar este vídeo?</p>
                                                                								<p class="text-warning"><small>{{$video->title}}</small></p>
                                                            								</div>
                                                            								<div class="modal-footer">
                                                                								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                								<a href="{{ url('/delete-video/'.$video->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                                            								</div>
                                                        								</div>
                                                    								</div>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- navegación con paginación: -->
                        
                        {{ $videos->links() }}
</div>

<div class="clearfix"></div>

@endsection
