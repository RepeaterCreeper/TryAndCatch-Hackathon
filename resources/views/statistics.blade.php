@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-warning">
                <div class="card-body">
                    <div style="display: flex; align-items: center;">
                        <h4 class="text-dark" style="flex: 1;">ACTIVE CASES</h4>
                    </div>
                    <h1 class="text-dark" style="font-weight: bold;">{{$active != 0 ? '+'.$active:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-danger">
                <div class="card-body">
                    <div style="display: flex; align-items: center;">
                        <h4 class="text-white" style="flex: 1;">NEW COVID CASES</h4>
                    </div>
                    <h1 style="font-weight: bold; color: white;">{{$count != 0 ? '+'.$count:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-success">
                <div class="card-body">
                    <h4 class="text-white">RECOVERED COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">{{$recover != 0 ? '+'.$recover:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-dark">
                <div class="card-body">
                    <h4 class="text-white">TOTAL COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">{{$total}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-primary">
                <div class="card-body">
                    <h4 class="text-white">REGISTERED POPULATION</h4>
                    <h1 style="font-weight: bold; color: white;">{{$population == 0 ? 'none': $population}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-dark">
                <div class="card-body">
                    <h4 class="text-white">Total Deaths</h4>
                    <h1 style="font-weight: bold; color: white;">{{$death == 0 ? 'none': $death}}</h1>
                </div>
            </div>
        </div>
    </div>

@endsection
