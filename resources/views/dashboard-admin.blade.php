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
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->address}}</td>
                        <td><a href="{{route('admin.view.image',$user->email)}}">View ID</a></td>
                        <td class="d-flex">
                            <form action="{{route('admin.add',$user->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <input type="text" hidden value="{{$user->id}}">
                                <button class="btn btn-success ml-2"><i class="fas fa-check"></i> Approve</button>
                            </form>

                            <form action="{{route('admin.reject',$user->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger ml-2"><i class="fas fa-ban"></i> Reject</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center bg-primary text-white-50"><h3>No records</h3></td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
