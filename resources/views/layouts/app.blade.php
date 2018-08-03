<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Times Printers') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
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
                    <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('tplogo.png')}}" width=180px; height=40px; style="padding-bottom: 3px;"/>
                        <!-- {{ config('app.name', 'Times Printers') }} -->
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                           
                        @else
                            <li>
                                <a href="{{route('home')}}" aria-expanded="false">
                                   Welcome: {{ Auth::user()->name }} 
                                </a>
                            </li>
                            @if( Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                            @endif
                            @if(Auth::user()->role != 'finance')
                            <li>
                            <a href="{{route('import')}}"> Production Import</a>
                            </li>
                            @endif
                            @if(Auth::user()->role != 'production')
                            <li>
                                <a href="{{route('import2')}}">Finance Import</a>
                            </li>
                            @endif

                            @if(Auth::user()->role == 'admin')
                            <li>
                                <a href="{{route('exportpg')}}">Export</a>
                            </li>
                            <li>
                                <a href="{{route('delete')}}">Delete</a>
                            </li>
                            
                            @endif
                            <li>
                                <a href="{{route('search')}}">Search</a>
                            </li>
                            @if(Auth::user()->role == 'admin')
                            <li>
                                <a href="{{route('insert')}}">Insert</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}">
                                            Logout
                                </a>
                            </li>
                            
                                    
                                    
                                
                          
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>

        @yield('content')
    <!-- Scripts -->
    
</body>
</html>
