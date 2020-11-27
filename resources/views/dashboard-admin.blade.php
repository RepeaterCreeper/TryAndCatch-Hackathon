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
                <li class="nav-item active">
                    <a class="nav-link" href="/dashboard-admin"><i class="fas fa-home"></i> Dashboard<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/announcement-admin"><i class="fas fa-bullhorn"></i> Announcements & Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/statistics-admin"><i class="fas fa-chart-bar"></i> Statistics</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1 class="display-4">Welcome back, Admin!</h1>
                <p class="lead">There are <b>2 new users</b> pending approval since you were last online.</p>
            </div>
        </div>
        <div class="col-sm-12 p-2">
            <div>
                <h2 style="margin-bottom: 0; display: flex; align-items: center; gap: 16px;">Pending Users <span style="font-size: 12pt;" class="badge badge-success">0</span></h2>
                <small>These are all the pending users.</small>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Image ID</th>
                        <th><th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Joseph</td>
                        <td>Chua</td>
                        <td><a href="#">View ID</a></td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-ban"></i> Reject</button>
                            <button class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Need an appointment?</h3>
                    <p>Schedule one today.</p>
                    <button class="btn btn-primary">Schedule an Appointment</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Get Documents</h3>
                    <p>Do you require a document? View all documents that you can request.</p>
                    <button class="btn btn-primary">View Documents</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Admin Support</h3>
                    <p>Having problems? Need to chat with the admin?</p>
                    <button class="btn btn-primary">Chat with Admin</button>
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
