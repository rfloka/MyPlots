@if (Auth::check() && Auth::user()->role == '4')
    <script>window.location = "/unveryacc";</script>
@endif 
@php
    $veri = DB::table('mails')->where('para','=', Auth::user()->email)->where('visto','=',0)->pluck('visto');
    if ($veri == "[]") {
       $noti = "none";
    }else{
        $noti = "";
    }
@endphp  
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyPlots - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?php echo asset('css/estilo.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/media.css')?>" type="text/css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default fixed-top navbar-expand-lg navbar-dark"  style="background-color:#2D4739;z-index:1;">
        <div class="container-fluid">
        <a class="navbar-brand" href="/"><img style="width:50px;" src="<?php echo asset('img/icon.png')?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
            @if (Auth::check() && Auth::user()->role < '3')
                <li class="nav-item ">
                    <a class="nav-link" href="/allusers"> <i class="fas fa-user-circle"></i> Utilizadores <span class="sr-only">(current)</span></a>
                </li>
            @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe-americas"></i> Terrenos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/allplots"><i class="far fa-list-alt"></i> Tabela</a>
                        <a class="dropdown-item" href="/mapsplot"><i class="fas fa-map-marked-alt"></i> Mapa</a>
                    </div>
                </li>
            </ul>
                <div class="dropdown">
                    <a style="color:white;" href="/ownerpro/{{Auth::user()->id}}" class="dropdown-toggle"  data-toggle="dropdown" >
                    <i class="far fa-user-circle"></i> {{Auth::user()->name}} <i class="fas fa-exclamation" style="display:{{$noti}};color:#09814A;"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="/ownerpro/{{Auth::user()->id}}"><i class="fas fa-eye"></i> Perfil</a>
                      <a class="dropdown-item" href="/inbox/{{Auth::user()->email}}"><i class="fas fa-inbox"></i>Mensagens <i class="fas fa-exclamation" style="display:{{$noti}};color:red;"></i></a>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                  </div>
        </div>
    </div>
    </nav>
        <div class="container" style="margin-top:10%;">
            @yield('content')
        </div>  
</body>

</html>
