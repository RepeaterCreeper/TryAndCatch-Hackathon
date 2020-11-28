@extends('layouts.app')
@section('content')
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
                    <h4 class="text-white">NEW COVID CASES</h4>
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
            <button class="btn btn-danger">Report Power Outage</button>
        </div>
    </div>
@endsection
