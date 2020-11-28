<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barangay Management System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <style>
        body {
            font-family: 'Nunito';
        }

    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item {{Request::is('announcement') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('site.announcement')}}"><i class="fas fa-bullhorn"></i> Announcements & Posts (Public)</a>
                    </li>

                    <li class="nav-item  {{Request::is('statistics') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('site.statistics')}}"><i class="fas fa-chart-bar"></i> Statistics (Public)</a>
                    </li>
                    @auth
                        <li class="nav-item {{Request::is('posts-user') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('user.posts')}}"><i class="fas fa-bullhorn"></i> Announcements & Posts (User)</a>
                        </li>
                        @if (auth()->user()->roles_id === 2)
                            <li class="nav-item  {{Request::is('dashboard-user') ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('user.dashboard')}}"><i class="fas fa-chart-bar"></i> Post Approval (User)</a>
                            </li>
                        @endif
                    @endauth
                    @auth
                    @if (auth()->user()->roles_id === 1)
                        <li class="nav-item  {{Request::is('dashboard-approval') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('admin.approval')}}"><i class="fas fa-home"></i> Post Approval (Admin)<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{Request::is('dashboard-admin') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Admin Dashboard<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{Request::is('announcement-admin') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('admin.announcement')}}"><i class="fas fa-bullhorn"></i> Announcements & Posts (Admin)</a>
                        </li>
                        <li class="nav-item {{Request::is('statistics-admin') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('admin.statistics')}}"><i class="fas fa-chart-bar"></i> Statistics (Admin)</a>
                        </li>
                    @endif
                    @endauth
                </ul>

                <ul class="ml-auto navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
         integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
     </script>--}}
    @stack('scripts')
</body>
</html>
