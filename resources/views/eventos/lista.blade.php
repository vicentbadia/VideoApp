@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-offset-1">
	<h2>Eventos Playlist</h2>
	<hr>

    @include('eventos.listaEventos')
 
</div>

@endsection
