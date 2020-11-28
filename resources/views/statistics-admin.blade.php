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
                <li class="nav-item">
                    <a class="nav-link" href="{{route('site.announcement')}}"><i class="fas fa-bullhorn"></i>
                        Announcements & Posts (Public)</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.posts')}}"><i class="fas fa-bullhorn"></i> Announcements &
                        Posts (User)</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('site.statistics')}}"><i class="fas fa-chart-bar"></i> Statistics
                        (Public)</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.dashboard')}}"><i class="fas fa-home"></i> Home (User)<span
                            class="sr-only">(current)</span></a>
                </li>
                @if (auth()->user()->roles_id === 1)
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Admin
                        Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('admin.announcement')}}"><i class="fas fa-bullhorn"></i>
                        Announcements & Posts (Admin)</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('admin.statistics')}}"><i class="fas fa-chart-bar"></i> Statistics
                        (Admin)</a>
                </li>
                @endif
                @endauth
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->first_name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="alert alert-danger m-2">
                <p style="margin: 0;"><b>Barangay Daan Pare</b> is currently experiencing power outage.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2 bg-danger">
                <div class="card-body">
                    <div style="display: flex; align-items: center;">
                        <h4 class="text-white" style="flex: 1;">NEW COVID CASES</h4>
                        <button class="btn btn-primary"><i class="fas fa-edit"></i> Update</button>
                    </div>
                    <h1 style="font-weight: bold; color: white;">+5</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2 bg-dark">
                <div class="card-body">
                    <h4 class="text-white">TOTAL COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">10</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2 bg-primary">
                <div class="card-body">
                    <h4 class="text-white">REGISTERED POPULATION</h4>
                    <h1 style="font-weight: bold; color: white;">35</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-6">
            <div class="card shadow m-2 border-primary">
                <div class="card-body">
                    <h1>Power Outage Reports</h1>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Citizen ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Report Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">00-0001</th>
                                <td>Joseph Chua</td>
                                <td>JavaScript, Void</td>
                                <td>11/28/2020 08:00:54 am</td>
                            </tr>
                        </tbody>
                    </table>
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
