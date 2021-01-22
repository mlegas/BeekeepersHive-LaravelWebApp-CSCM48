<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="https://unpkg.com/vue@next" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-info">
            <div class="container">
                <a class="navbar-brand abs" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('posts.index') }}">{{ 'Home' }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('posts.create') }}">{{ 'Post' }}</a>
                            </li>
                        </ul>
                    @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto mt-2">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ 'Login' }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ 'Register' }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->successfully_registered)
                                @if (Auth::user()->profile->name_displayed == Auth::user()->name)
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                                <a class="nav-link text-white pe-4" href="{{ route('profilepages.show', ['profile_page' => Auth::user()->profile->profilePage]) }}">{{ Auth::user()->name }}</a>
                                        </li>
                                    </ul>
                                @else
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <p class="text-white">
                                                    <a class="nav-link text-white pe-4" href="{{ route('profilepages.show', ['profile_page' => Auth::user()->profile->profilePage]) }}">{{ Auth::user()->profile->name_displayed }} ({{ Auth::user()->name }})</a>
                                                </p>
                                            </li>
                                        </ul>
                                @endif
                            @else
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <p class="text-white pe-4">
                                            {{ Auth::user()->name }}
                                        </p>
                                    </li>
                                </ul>
                            @endif
                            @if (Route::has('logout'))
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary"> Logout </button>
                                        </form>
                                    </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="text-center pt-2 pb-1 rounded-pill" style="background-color: rgba(0, 0, 0, 0.1)">
        <strong> {{ date('Y-m-d') }}, Beekeepers Hive. </strong>
        <p> The friendliest place for all beekeepers on the planet Earth (and possibly beyond). </p>
    </footer>
</body>
</html>
