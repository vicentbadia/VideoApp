<!--Cargamos primero la configuración de estilos de la plantilla maestra de la aplicación:-->
@extends('layouts.app')

@section('content')  <!--ponemos el contenido dentro de una sección de la plantilla maestra-->

<div class="col-md-10 col-md-offset-1">
    <h2>Crear nuevo evento</h2>
    <hr>
    <form action="{{ route('guardarEvento') }}" method="post" enctype="multipart/form-data" class="col-lg-6 col-lg-offset-2">

        {!!  csrf_field() !!}   <!--llamada a un helper para evitar ataques en los formularios-->

        <!-- Mostrar los errores que se detecten tras enviar el formulario al controlador -->
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
            <label for="title">Id Evento</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ old('id') }}" placeholder="Máx. 8 caracteres">
        </div>
        <div class="form-group">
            <label for="description">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <button type="submit" class="btn btn-success">Crear evento</button>

    </form>
</div>

@endsection