<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            background-color: #31363F;
            margin-bottom: 60px;
        }
        .navbar {
            background-color:  #000;
        }
        .navbar .nav-link {
            color: white !important;
        }
        .card {
            background-color: #76ABAE;
        }
        .card-header{
            background-color: #000;
            color: white;
        }
        .kep {
            max-width: auto;
            max-height: 150px;
        }
        .books{
            max-height: 600px;
        }
        .footer {
            background-color: #EEEEEE;
            color: black;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books') }}">{{ __('Books') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('add_book') }}">{{ __('Add Book') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('delete_books') }}">{{ __('Delete Book') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('adminorders') }}">{{ __('Orders') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users') }}">{{ __('Users') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books') }}">{{ __('Books') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('shop') }}">{{ __('Shop') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my_orders') }}">{{ __('My Orders') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                </li>
                            @endif
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <footer class="footer">
            <div class="container">
                <span>© 2024 Webshop</span>
            </div>
        </footer>
        @stack('scripts')
    </div>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
        alert(msg);
        }
    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
