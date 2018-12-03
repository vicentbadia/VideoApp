<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VideoApp · Crossplatform videocontroller</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet"> 

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /*font-family: 'Raleway', sans-serif;*/
                font-family: 'Dosis', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

             .links > a:hover {
                color: #3c9c97;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: underline;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <!-- En lugar de ir a la página de inicio, vamos a la Playlist de Eventos -->
                        <!-- <a href="{{ url('/home') }}">Home</a> -->
                        <a href="{{ route('listaEventos') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <!--<a href=" //route('register') }}">Register</a>-->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="margin:15px">
                    <!--VideoApp--> 
                    <img src="{{asset('img/videoapp.png')}}" class="img-fluid" style="max-width:100%; height: auto;" alt="VideoApp Crossplatform Videocontroller">
                    <p style="font-size:22px; letter-spacing: .1rem;">Crossplatform Videocontroller</p>
                </div>
                <hr />
                <!-- MENU DOCUMENTACIÓN -->
                <!--<div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>-->
            </div>
        </div>
    </body>
</html>
