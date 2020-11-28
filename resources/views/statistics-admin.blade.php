@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="alert alert-danger m-2">
                <p style="margin: 0;"><b>Barangay Daan Pare</b> is currently experiencing power outage.</p>
            </div>
        </div>
        <div class="col-sm-3">
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
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-success">
                <div class="card-body">
                    <h4 class="text-white">RECOVERED COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">+3</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-dark">
                <div class="card-body">
                    <h4 class="text-white">TOTAL COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">7</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
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
@endsection
