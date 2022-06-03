<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('home*') ? 'text-primary' : '' }}" href="{{ url('/home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('article*') ? 'text-primary' : '' }}" href="{{ route('login') }}">Article</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('category*') ? 'text-primary' : '' }}" href="{{ route('category') }}">Category</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h2>Create Category</h2>
                </div>
                <div class="col-auto">
                    <a class="btn btn-secondary" href="{{ route('category') }}" target="_blank">Back</a>
                </div>
            </div>
            <hr>
            <div class="container" style="width: 500px">
                    <form method="POST" action="{{route('category.store')}}">
                        @csrf
                        <div class="form-group">
                          <label for="name">Category</label>
                          <input type="text" class="form-control @error('name') is-invalid
                          @enderror" name="name" id="name" aria-describedby="name" placeholder="Enter category">
                          @error('name')
                              <div class="invalid-feedback">
                                    {{$message}}
                              </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
