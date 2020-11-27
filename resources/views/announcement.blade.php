<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Barangay Management System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <style>
        body {
            font-family: 'Nunito';
        }

    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> Dashboard<span
                                class="sr-only">(current)</span></a>
                    </li>
                @endauth
                <li class="nav-item active">
                    <a class="nav-link" href="/announcement"><i class="fas fa-bullhorn"></i> Announcements & Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/statistics"><i class="fas fa-chart-bar"></i> Statistics</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
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

    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Announcement</h1>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow bg-dark text-white">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle" style="width: 64px; height: 64px; background-color: red; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">J</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Joseph Chua <span class="badge badge-pill badge-small bg-primary" style="font-size: 12pt;">Mayor</span></h3>
                            <small>2 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum repellendus amet optio at, soluta, quis earum non quos vitae a iusto quam neque, doloribus adipisci! Eligendi iusto veritatis ratione accusantium?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Recent Ka-Baranggay Posts</h1>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow border-primary">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: purple; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">D</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Darwin Marcello <span class="text-white badge badge-pill badge-small bg-warning" style="font-size: 12pt;">Developer</span></h3>
                            <small>5 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum repellendus amet optio at, soluta, quis earum non quos vitae a iusto quam neque, doloribus adipisci! Eligendi iusto veritatis ratione accusantium?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow border-primary">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: green; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">J</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Justin Jhun Quilit <span class="text-white badge badge-pill badge-small bg-info" style="font-size: 12pt;">UX Designer</span></h3>
                            <small>5 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum repellendus amet optio at, soluta, quis earum non quos vitae a iusto quam neque, doloribus adipisci! Eligendi iusto veritatis ratione accusantium?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-2">
            <div class="card mx-4 p-4 shadow border-primary">
                <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px;">
                        <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: #C08552; display: flex; justify-content: center; align-items: center;">
                            <h3 style="margin: 0;">C</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0;">Csyronne Galang <span class="text-white badge badge-pill badge-small bg-danger" style="font-size: 12pt;">UX Designer</span></h3>
                            <small>5 minutes ago</small>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum repellendus amet optio at, soluta, quis earum non quos vitae a iusto quam neque, doloribus adipisci! Eligendi iusto veritatis ratione accusantium?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
