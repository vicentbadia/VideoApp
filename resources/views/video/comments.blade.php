<hr />
<h4>Comentarios</h4>
<hr />

       <!-- Devolver un mensaje después de guardar en la base de datos -->
	   @if (session('message'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif

<!-- si el usuario está loggeado, se muestra el formulario -->
@if (Auth::check())
<form class="col-md-4" method="POST" action="{{ url('/comment') }}">
	{!! csrf_field() !!}
	<!— campo oculto para pasar la id del video —>
	<input type="hidden" name="video_id" value="{{$video->id}}" required />
	<p>
		<textarea class="form-control" name="body" required></textarea>
	</p>
	<input type="submit" value="Enviar comentario" class="btn btn-success" />
</form>
<div class="clearfix"></div><hr />
@endif

@if (isset($video->comments))
	<div id="comments-list">
		@foreach($video->comments as $comment)
			<div class="comment-item col-md-12 pull-left">
				
		        <div class="panel panel-default comment-data">
			        <div class="panel-heading">
				        <div class="panel-title">
					        Enviado por <strong>{{ $comment->user->name.' '.$comment->user->surname }}</strong> · {{ \FormatTime::LongTimeFilter($comment->created_at) }}
				        </div>
			        </div>
			        <div class="panel-body">
				        {{ $comment->body }}
						<!--si el usuario está identificado Y es el autor del comentario o ha subido el vídeo: -->
						@if (Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
							<!--vamos a utilizar un modal de Bootstrap para crear un overlay que nos pida confirmación
							//https://victorroblesweb.es/2018/01/19/crear-pop-up-overlay-modal-en-bootstrap/ -->
							<!-- Botón en HTML (lanza el modal en Bootstrap) -->
							<!-- Añadimos en la url del botón el id del comentario: -->
							<div class="pull-right">
								<a href="#victorModal{{$comment->id}}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>
  
								<!-- Modal / Ventana / Overlay en HTML -->
								<div id="victorModal{{$comment->id}}" class="modal fade">
    								<div class="modal-dialog">
        								<div class="modal-content">
            								<div class="modal-header">
                								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                								<h4 class="modal-title">¿Estás seguro?</h4>
            								</div>
            								<div class="modal-body">
                								<p>¿Seguro que quieres borrar este comentario?</p>
                								<p class="text-warning"><small>{{$comment->body}}</small></p>
            								</div>
            								<div class="modal-footer">
                								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                								<a href="{{ url('/delete-comment/'.$comment->id) }}" type="button" class="btn btn-danger">Eliminar</a>
            								</div>
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
@endif