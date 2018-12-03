@extends('layouts.app')

@section('content')

        <div class="col-md-10 col-md-offset-1">
            <h2>¡Hola {{ Auth::user()->name }}!</h2>
            <hr>

                @if (session('status'))
                     <div class="alert alert-success">
                            {{ session('status') }}
                    </div>
                @endif

            <!-- Lista de videos o ids para la pag de inicio -->
            
        </div>
@endsection
