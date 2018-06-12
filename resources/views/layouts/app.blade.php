<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MobiAgente</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom_app.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fa fa-home" aria-hidden="true"></i> MobiAgente
                </a>
            </div>
            
            

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
                
                <!--Main Menu -->
                
                <ul class="nav navbar-nav">
                    <!--Usuarios -->
                    @if((Auth::user()->role=="Super usuario") or (Auth::user()->role=="Administrativo"))
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios 
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('/user/create')}}">Crear</a></li>
                        <li><a href="{{url('/user')}}">Ver/Editar</a></li>  
                      </ul>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role=="Super usuario")
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inmobiliarias 
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('/inmobiliaria/create')}}">Crear</a></li>
                        <li><a href="{{url('/inmobiliaria')}}">Ver/Editar</a></li>
                      </ul>
                    </li>
                    @endif

                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inmuebles 
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('/inmueble/create')}}">Crear</a></li>
                        <li><a href="{{url('/inmueble')}}">Ver/Editar</a></li>
                      </ul>
                    </li>
                    
                </ul>
                

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/user/create') }}">Register</a></li>
                    @else
                        @if (file_exists (public_path('storage/avatars/'.Auth::user()->id.'.jpeg')))
                        <li><img class="avatar" src="{{asset('storage/avatars/'.Auth::user()->id.'.jpeg')}}"></li>
                        @else
                        <li><img class="avatar" src="/storage/avatars/generic-avatar.png"></li>
                        @endif
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

     <!-- Scripts -->
    <script src="/js/app.js"></script>

    @yield('content')


</body>
</html>
