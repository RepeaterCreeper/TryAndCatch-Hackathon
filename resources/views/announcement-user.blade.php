@extends('layouts.app')
@section('content')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Announcement</h1>
        </div>
        @forelse($announcements as $announcement)
            <div class="col-sm-6 my-2">
                <div class="card mx-4 p-4 shadow bg-dark text-white">
                    <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 16px;">
                            <div class="rounded-circle" style="width: 64px; height: 64px; background-color: red; display: flex; justify-content: center; align-items: center;">
                                <h3 style="margin: 0;">{{$announcement->user->first_name[0]}}</h3>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h3 style="margin: 0;">{{$announcement->user->first_name." ".$announcement->user->last_name}} <span class="badge badge-pill badge-small bg-primary" style="font-size: 12pt;">{{$announcement->user->tag->name}}</span></h3>
                                <small>{{$announcement->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <div>
                            <img src="{{asset('storage/images/posts/'.$announcement->user->id. "/". $announcement->image)}}" alt="" class="img-fluid w-25">
                            <p style="margin: 0;">{{$announcement->caption}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h2>There is no announcement.</h2>
        @endforelse
    </div>

    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Recent Ka-Baranggay Posts</h1>
        </div>
        <div class="col-sm-12">
            @auth
                @if (auth()->user()->roles_id === 2)
                    <form class="col-sm-8 offset-sm-2" action="{{route('user.post.store')}}">
                        @include('flash.message')
                        <textarea class="form-control  @error('caption') is-invalid @enderror" name="caption" rows="6" placeholder="Character limit of 150."></textarea>
                        @error('caption')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                        @enderror
                        <button class="btn btn-primary mt-2" type="submit">Add Post</button>
                    </form>
                @endif
            @endauth
        </div>
        @forelse ($posts as $post)
            <div class="col-sm-6 my-2">
                <div class="card mx-4 p-4 shadow border-primary">
                    <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 16px;">
                            <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: green; display: flex; justify-content: center; align-items: center;">
                                <h3 style="margin: 0;">J</h3>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h3 style="margin: 0;">{{$post->user->first_name. " ". $post->user->last_name}}<span class="text-white badge badge-pill badge-small bg-info" style="font-size: 12pt;">{{$post->user->tag->name}}</span></h3>
                                <small>{{$post->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <div>
                            <p style="margin: 0;">{{$post->caption}}</p>
                        </div>
                    </div>
                </div>
            </div>
    @empty
        <h2 class="text-center w-100 text-primary font-weight-bold mt-5">There are no post yet.</h2>
    @endforelse
@endsection
