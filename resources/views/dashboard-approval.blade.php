@extends('layouts.app')


@section('content')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1 class="display-4">Welcome back, {{auth()->user()->first_name}}</h1>
                <p class="lead">There are no new updates since you were last online.</p>
            </div>
        </div>
        <div class="col-sm-12 p-2">
            <div>
                <h2 style="margin-bottom: 0;">Pending Posts</h2>
                <small>These are all your posts that are <b>PENDING</b> approval</small>
            </div>
            @include('flash.message')
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
                        <td class="d-flex justify-content-start">
                            <form action="{{route('admin.post.deny')}}" class="mr-2" method="post">
                                @method('patch')
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="id">
                                <button class="btn btn-danger">Cancel</button>
                            </form>
                            <form action="{{route('admin.post.approve')}}" method="post">
                                @method('patch')
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="id">
                                <button class="btn btn-success">Approve</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr > <td class="text-center" colspan="4"><h2>There are no submissions of post.</h2></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
