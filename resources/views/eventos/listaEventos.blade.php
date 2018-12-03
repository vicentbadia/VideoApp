                     <!--listado de videos: -->
                     <div class="panel panel-default">
                        <!-- Panel para la lista de eventos cargados desde el servidor -->
                        <div class="panel-heading" id="titulo-eventos">
                            <h3>Eventos del servidor</h3>
                        </div>
                        <div class="panel-body" id="body-eventos">
                
                            Eventos cargados desde la API

                        </div>
        
                        <!-- Panel para los eventos creados en la base de datos por el usuario -->
                        <div class="panel-heading" id="titulo2-eventos">
                            <h3>Eventos de usuario</h3>
                        </div>
                        <div class="panel-body" id="body-eventos">
                            <!-- Formulario para enviar el evento a Cue, Play o Stop: -->
                            <form action="{{ route('cambiarEvento') }}" method="post" enctype="multipart/form-data" class="">
                                {!!  csrf_field() !!}   <!--llamada a un helper para evitar ataques en los formularios-->
                
                            @php ($numEventos = 0)
                            @foreach($eventos as $evento)
                                <div class="video-item col-sm-12 pull-left">
                                    <div class="data col-sm-1 col-xs-3 pull-left" style="line-height:5px">
                                            <!-- El botón Eliminar aparece si el usuario está identificado y es el autor del Evento o es Administrador -->
                                            @if (Auth::check() && (Auth::user()->id == $evento->user_id || Auth::user()->role == 'Admin'))

                                                <!--Boton Eliminar con ventana modal para pedir confirmación -->
                                                <a href="#victorModal{{$evento->eventID}}" role="button" class="btn btn-xs btn-danger" data-toggle="modal">X</a>
  
                                                <!-- Modal / Ventana / Overlay en HTML -->
                                                <div id="victorModal{{$evento->eventID}}" class="modal fade">
                                                    								<div class="modal-dialog">
                                                        								<div class="modal-content">
                                                            								<div class="modal-header">
                                                                								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                								<h4 class="modal-title">¿Estás seguro?</h4>
                                                            								</div>
                                                            								<div class="modal-body">
                                                                								<p>¿Seguro que quieres borrar este evento?</p>
                                                                								<p class="text-warning"><small>{{$evento->title}}</small></p>
                                                            								</div>
                                                            								<div class="modal-footer">
                                                                								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                								<a href="{{ url('/delete-event/'.$evento->eventID) }}" type="button" class="btn btn-danger">Eliminar</a>
                                                            								</div>
                                                        								</div>
                                                    								</div>
                                                </div>

                                            @endif
                                    </div>

                                    <div class= "data col-sm-1 col-xs-8 pull-left">
                                        <strong>{{ $evento->eventID}}</strong>
                                    </div>
                                    <div class= "data col-sm-4 col-xs-12 pull-left">
                                        {{ $evento->title }} 
                                    </div>
                                    <div class= "data col-sm-2 col-xs-6 pull-left">
                                            <!-- usando la función creada en el modelo Event: -->
                                            <!-- $evento->estado->name -->
                                            @switch($evento->estado->name)
                                                @case ('Cue')
                                                    <span style="color:darkcyan; font-weight: bold;">{{ $evento->estado->name }}</span>
                                                @break;
                                            
                                                @case ('Play') 
                                                    <span style="color:green; font-weight: bold;">{{ $evento->estado->name }}</span>
                                                @break;
                                    
                                                @case ('Stop')
                                                    <span style="color:orangered; font-weight: bold;">{{ $evento->estado->name }}</span>
                                                @break;
                                            @endswitch
                                    </div>
                                    <!-- Columna para el radiobutton: -->
                                    <div class="data col-sm-1 col-xs-6 pull-left">
                                            <div class="radio">
                                                    <label><input type="radio" name="optradio" value="{{$evento->eventID}}"></label>
                                            </div>
                                    </div>
                                </div>
                                @php ($numEventos = $numEventos + 1)
                            @endforeach
                     
                            <!--Habilitar los botones sólo si hay eventos-->
                            @if ($numEventos > 0)
                                @php($boton='')
                            @else 
                                @php($boton='disabled')
                            @endif

                            <!-- Columna para los botones Cue, Play y Stop: -->
                            <div class="clearfix"></div>
                            <div class="data col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary" name="submitbutton" value="Cue" {{$boton}}>Cue</button>
                                <button type="submit" class="btn btn-success" name="submitbutton" value="Play" {{$boton}}>Play</button>
                                <button type="submit" class="btn btn-danger" name="submitbutton" value="Stop" {{$boton}}>Stop</button>
                            </div>
                            </form>
                            <!-- navegación con paginación: -->    
                            {{ $eventos->links() }}
                        </div>
                    </div>