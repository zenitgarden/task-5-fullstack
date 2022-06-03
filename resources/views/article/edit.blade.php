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
                    <h2>Edit Article</h2>
                </div>
                <div class="col-auto">
                    <a class="btn btn-secondary" href="{{ route('article') }}" target="_blank">Back</a>
                </div>
            </div>
            <hr>
            <div class="container" style="width: 500px">
                    <form method="POST" action="{{route('article.update',$article->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" class="form-control @error('title') is-invalid
                          @enderror" value="{{old('title',$article->title)}}" name="title" id="title" aria-describedby="name" placeholder="Enter Title">
                          @error('title')
                              <div class="invalid-feedback">
                                    {{$message}}
                              </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Category</label>
                            <select id="select-2-c" name="category_id"  class="form-control @error('category_id') is-invalid
                            @enderror" data-placeholder="Choose category">
                                    @foreach ($categories as $c)
                                    @if (old('category_id',$article->category_id == $c->id))
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                    @else
                                        <option value="{{$c->id}}" >{{$c->name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                            @error('category_id')
                              <div class="invalid-feedback">
                                    {{$message}}
                              </div>
                            @enderror
                          </div>

                          <div class="form-group">
                            <label for="name">Content</label>
                            <textarea type="text" class="form-control @error('content') is-invalid
                            @enderror" name="content" id="content" aria-describedby="content" placeholder="Enter content">{{old('content',$article->content)}}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                      {{$message}}
                                </div>
                              @enderror
                          </div>

                          <div class="form-group mt-4">
                            <input type="hidden" name="oldImage" value="{{$article->image}}">
                            <label for="name">Image</label>
                            <input class="custom-file-input @error('image') is-invalid @enderror" type="file" 
                            id="image" name="image" onChange="previewImage()" >
                            @error('image')
                                <div class="invalid-feedback">
                                      {{$message}}
                                </div>
                              @enderror
                          </div>
                          @if ($article->image)
                            <img class="img-preview img-fluid mx-auto d-block mt-3" src="{{asset($article->image)}}">
                          @endif

                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        let file = document.getElementById("image");
         function previewImage(){

            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            var fileName = file.value,
            idxDot = fileName.lastIndexOf(".") + 1,
            extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

               imgPreview.style.display = 'block';

               const oFReader = new FileReader();
               oFReader.readAsDataURL(image.files[0]);

               oFReader.onload = function(oFREvent){
               imgPreview.src = oFREvent.target.result;
               }
            
        }
    </script>
</body>
</html>
