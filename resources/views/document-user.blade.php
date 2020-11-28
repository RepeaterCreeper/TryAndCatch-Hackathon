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
        <div class="col col-sm-12">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Hi, John</h3>
                    <p>What kind of documents do you need?</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Document Selection</label>
                        <select class="form-control" id="document-selection">
                            <option default selected disabled>Please select a document...</option>
                            <option value="certresidency">Certificate of Residency</option>
                            <option value="certvalidid">Certificate of Valid ID</option>
                            <option value="certguardianship">Certification of Guardianship</option>
                            <option value="brgclearance">Barangay Clearance</option>
                            <option value="brgclearance_installation">Barangay Clearance for Installation</option>
                            <option value="brgclearance_businesspermit">Barangay Clearance for Business Permit Application</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-12">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Document Preview - <span>Barangay Clearance</span></h3>
                    <p>This is the form you need to fill out to request for the selected document.</p>
                </div>
                <div class="card-body">
                    <form>
                        <div data-id="document-data">
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label for="purpose_requests">Purpose of Request</label>
                                <input type="text" class="form-control" placeholder="Purpose of Requests"
                                    name="purpose_requests" id="purpose_requests">
                            </div>
                        </div>
                        <div class="form-row">
                            <button class="btn btn-success" type="submit">Submit Request</button>
                        </div>
                    </form>
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

    <script>
        document.querySelector("#document-selection").addEventListener("change", function (e) {
            let value = e.srcElement.value;

            let documents = {
                "certresidency": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`,
                "certvalidid": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`,
                "certguardianship": `<div class="form-row"> <div class="form-group col-sm-10"> <label for="guardian_name">Guardian Name</label> <input type="text" class="form-control" name="guardian_name" id="guardian_name" placeholder="Guardian Name"> </div></div><div class="form-row"> <div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="guardian_name" placeholder="Full Name"> </div></div>`,
                "brgclearance": `<div class="form-row">
                    <div class="form-group col-sm-1"><label for="suffix">Suffix</label><select class="form-control"
                            name="suffix" id="suffix">
                            <option value="mr">Mr.</option>
                            <option value="ms">Ms.</option>
                            <option value="mrs">Mrs.</option>
                        </select> </div>
                    <div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text"
                            class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div>
                    <div class="form-group col-sm-1"> <label for="civil_status">Civil Status</label> <select
                            name="civil_status" class="form-control" id="civil_status">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select> </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6"> <label for="age">Age</label> <input type="number"
                            class="form-control" placeholder="Age" name="age" id="age"> </div>
                    <div class="form-group col-sm-6"> <label for="residence-number">Residence Number</label> <input
                            type="number" class="form-control" placeholder="Residence Number" name="residence-number"
                            id="residence-number"> </div>
                </div>`,
                "brgclearance_businesspermit": `<div class="form-row"> <div class="form-group col-sm-12"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div><div class="form-group col-sm-12"> <label for="contact_no">Contact No.</label> <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No."> </div><div class="form-group col-sm-12"> <label for="business_type">Type of Business</label> <input type="text" class="form-control" name="business_type" id="business_type" placeholder="Business Type"> </div><div class="form-group col-sm-12"> <label for="business_location">Business Location</label> <input type="text" class="form-control" name="business_location" id="business_location" placeholder="Business Location"> </div><div class="form-group col-sm-12"> <div class="custom-file"> <input type="file" name="business_location_sketch" class="custom-file-input" id="business_location_sketch"> <label class="custom-file-label" for="business_location_sketch">Attach Sketch Map</label> </div></div><div class="form-group col-sm-12"> <div class="form-group" data-id="business_ownership"> <label for="business_ownership">Business Ownership</label> <select class="form-control" id="business_ownership" name="business_ownership"> <option value="rented">Rented</option> <option value="owned">Owned</option> <option value="others">Others Specify</option> </select> </div><div class="form-group" data-id="business_ownership_other"> <label for="business_ownership_other">Business Ownership Other (optional if RENTED or OWNED):</label> <input type="text" class="form-control" name="business_ownership_other" id="business_ownership_other"> </div></div></div><div class="form-row"> <div class="form-group col-sm-6"> <label for="age">Comm Tax Cert. No. (Cedula)</label> <input type="number" class="form-control" placeholder="Age" name="age" id="age"> </div><div class="form-group col-sm-6"> <label for="residence-number">Residence Number</label> <input type="number" class="form-control" placeholder="Residence Number" name="residence-number" id="residence-number"> </div></div>`,
                "brgclearance_installation": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`
            };

            document.querySelector("*[data-id='document-data']").innerHTML = documents[value];
        });

    </script>
</body>

</html>
