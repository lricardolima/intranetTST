<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Scripts -->

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles/nav.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles/defaults.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="shortcut icon" href="{{asset('img/logo-favicon.png')}}" type="image/x-icon">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img\bg.png')}}" width='150'>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active ml-3">
                            <a href="{{url('http://chamados.meridionalsaude.com.br')}}" class="btn mt-3" id="button-default">Chamados GLPI</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item active ml-3">
                            <a class="nav-link" href="{{url('/')}}"><span>Home</span></a>
                        </li>
                        <li class="nav-item active ml-3"><a class="nav-link" href="{{ route('sector') }}"><span>Setores</span></a></li>
                        <li class="nav-item active ml-3"><a class="nav-link" href="{{ route('branch.index') }}"><span>Ramais</span></a></li>
                        <li class="nav-item active ml-3"><a class="nav-link" href="{{ url('http://outlook.office.com') }}"><span>E-mail</span></a></li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item ml-3" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    </a>
                                    <a class="dropdown-item ml-3" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('session')
            @include('layouts.modal')
        </div>
        <main class="container col-sm-11">
            @include('layouts.flash-message')
            @yield('content')
        </main>
        <div class="">
            @include('layouts.footer')
        </div>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
    </div>
</body>
</html>
