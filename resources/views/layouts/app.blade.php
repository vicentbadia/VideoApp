<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VideoApp · Crossplatform videocontroller</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- estilos personalizados -->
    <link rel="stylesheet" href="{{  URL::asset('css/style.css') }}" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="nombreApp">VideoApp · VideoController</div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav" style="padding-top:5px">
                        <!-- FORMULARIO BUSCADOR
                        <form class=“navbar-form navbar-left” role="search" action="">
                    
                                <li style="float:left">
		                        <input type="text" class="form-control" placeholder="Buscar" name="search">
                                </li><li style="float:left">
		                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-envelope" style="font-size: 20px">
		                        </button>
                                </li>
            
                        </form>
                        -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="{{ route('listaEventos') }}" title="lista de eventos">Eventos Playlist</a>
                            </li>
                            <li>
                                <a href="{{ route('crearEventos') }}" title="crear nuevo evento">Crear evento</a>
                            </li>
                            <li>
                                <a href="{{ route('listaVideos') }}" title="video playlist">Video Playlist</a>
                            </li>
                            <li>
                                <a href="{{ route('createVideo') }}" title="subir videos">Subir video</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Devolver un mensaje después de guardar en la base de datos -->
        @if (session('message'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="col-md-10 col-md-offset-1">
	    <hr />
	    <!-- <p>&copy; BierZoft · Proudly made in Cabanyal · 2018</p> -->
        <p style="font-size: 10px">&copy; Eduardo Alonso · Antonio Fernández · Vicent Badia - 2018</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
