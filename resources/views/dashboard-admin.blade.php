@extends('layouts.app')
@section('content')

    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1 class="display-4">Welcome back, {{auth()->user()->first_name}}!</h1>
                <p class="lead">There are <b>{{$users->count()}} new user/s</b> pending approval since you were last online.</p>
            </div>
        </div>
        <div class="col-sm-12 p-2">
            <div>
                <h2 style="margin-bottom: 0; display: flex; align-items: center; gap: 16px;">Pending Users <span style="font-size: 12pt;" class="badge badge-success">{{$users->count()}}</span></h2>
                <small>These are all the pending users.</small>
            </div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Image ID</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->address}}</td>
                        <td><a href="{{route('admin.view.image',$user->email)}}">View ID</a></td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-ban"></i> Reject</button>
                            <button class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                        </td>
                    </tr>
                @endforeach

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
@endsection
