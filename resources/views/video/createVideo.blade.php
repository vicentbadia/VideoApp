
<!--Cargamos primero la configuración de estilos de la plantilla maestra de la aplicación:-->
@extends('layouts.app')

@section('content')  <!--ponemos el contenido dentro de una sección de la plantilla maestra-->

<div class="col-md-10 col-md-offset-1">
        <h2>Crear nuevo video</h2>
        <hr>
        <form action="{{ route('saveVideo') }}" method="post" enctype="multipart/form-data" class="col-lg-6 col-lg-offset-2">

            {!!  csrf_field() !!}   <!--llamada a un helper para evitar ataques en los formularios-->

            <!-- Mostrar los errores que se detecten tras enviar el formulario en saveVideo, en el controlador -->
            @if($errors->any())
	            <div class="alert alert-danger">
		            <ul>
			            @foreach($errors->all() as $error)
				            <li>{{ $error  }}</li>
			            @endforeach
		            </ul>
	            </div>
            @endif

            <div class="form-group">
	            <label for="title">Título</label>
	            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
	            <label for="description">Descripción</label>
	            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
	            <label for="image">MIniatura</label>
	            <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
	            <label for="video">Archivo de vídeo</label>
	            <input type="file" class="form-control" id="video" name="video">
            </div>
            <button type="submit" class="btn btn-success">Crear video</button>
        </form>
</div>


@endsection