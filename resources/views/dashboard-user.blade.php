@extends('layouts.app')
@section('content')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1 class="display-4">Welcome back, {{auth()->user()->first_name}}</h1>
                <p class="lead">We are happy that you're here!</p>
            </div>
        </div>
        <div class="col-sm-12 p-2">
            <div>
                <h2 style="margin-bottom: 0;">Pending Posts</h2>
                <small>These are all your posts that are <b>PENDING</b> approval</small>
            </div>
            @include('flash.message')
            @auth
                @if (auth()->user()->roles_id==2)
                    <div class="row no-gutters d-flex justify-content-end my-2">
                        <form action="{{route('user.report')}}" method="post">
                            @csrf
                            <button class="btn btn-danger ml-2">Report Power Outage</button>
                        </form>
                    </div>
                @endif
            @endauth
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Content</th>
                    <th scope="col">Submitted</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td style="max-width: 256px;">{{$post->caption}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                          @if ($post->status)
                                <form action="{{route('user.post.cancel')}}" method="post">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" value="{{$post->id}}" name="id">
                                    <button class="btn btn-danger">Cancel</button>
                                </form>
                            @else
                                <span class="text-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr > <td class="text-center" colspan="4"><h2>There are no submissions of post.</h2></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Need an appointment?</h3>
                    <p>Schedule one today.</p>
                    <a href="{{route('user.appointnment')}}" class="btn btn-primary">Schedule an Appointment</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Get Documents</h3>
                    <p>Do you require a document? View all documents that you can request.</p>
                    <a href="{{route('user.document')}}" class="btn btn-primary">View Documents</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow m-2">
                <div class="card-body">
                    <h3 style="margin-bottom: 0; font-weight: bolder;">Admin Support</h3>
                    <p>Having problems? Need to chat with the admin?</p>
                    <a href="{{route('admin.support')}}" class="btn btn-primary">Chat with Admin</a>
                </div>
            </div>
        </div>
    </div>
@endsection
