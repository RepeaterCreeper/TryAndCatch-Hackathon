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
        <div class="col col-sm-8">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h1 style="margin-bottom: 0;">Request for an Appointment</h1>
                    <p class="lead">You can request for an appointment, but the time and date set is NOT guaranteed.
                        This is up to the Admin's discretion.</p>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="appointment_date" class="col-md-12">{{ __('Appointment Date') }}</label>
                            <div class="col-md-12">
                                <input type="appointment_date" class="form-control is-invalid" name="appointment_date"
                                    autocomplete="appointment_date" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="appointment_time" class="col-md-12">{{ __('Appointment Time') }}</label>
                            <div class="col-md-12">
                                <input type="time" class="form-control is-invalid" name="appointment_time"
                                    autocomplete="appointment_time" autofocus>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success float-right">Submit Request</button>
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Pending Appointments</h3>
                    <p>These are all your pending appointments.</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Appointment ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>November 30, 2020</td>
                                <td>11:00 am</td>
                                <td><span class="badge badge-warning text-white">PENDING</span></td>
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
