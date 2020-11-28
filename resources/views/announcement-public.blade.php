@extends('layouts.app')
@section('content')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Announcement</h1>
        </div>
        @foreach($posts as $post)
            @if ($post->important)
                <div class="col-sm-6 my-2">
                    <div class="card mx-4 p-4 shadow bg-dark text-white">
                        <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                            <div style="display: flex; gap: 16px;">
                                <div class="rounded-circle" style="width: 64px; height: 64px; background-color: red; display: flex; justify-content: center; align-items: center;">
                                    <h3 style="margin: 0;">{{$post->user->first_name[0]}}</h3>
                                </div>
                                <div style="display: flex; flex-direction: column; justify-content: center;">
                                    <h3 style="margin: 0;">{{$post->user->first_name." ".$post->user->last_name}} <span class="badge badge-pill badge-small bg-primary" style="font-size: 12pt;">Mayor</span></h3>
                                    <small>{{$post->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                            <div>
                                <p style="margin: 0;">{{$post->caption}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Recent Admin Posts</h1>
        </div>
        @foreach($posts as $post)
            @if (!$post->important)
                <div class="col-sm-6 my-2">
                    <div class="card mx-4 p-4 shadow border-primary">
                        <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                            <div style="display: flex; gap: 16px;">
                                <div class="rounded-circle text-white" style="width: 64px; height: 64px; background-color: purple; display: flex; justify-content: center; align-items: center;">
                                    <h3 style="margin: 0;">{{$post->user->first_name[0]}}</h3>
                                </div>
                                <div style="display: flex; flex-direction: column; justify-content: center;">
                                    <h3 style="margin: 0;">{{$post->user->first_name . " ". $post->user->last_name}} <span class="text-white badge badge-pill badge-small bg-warning" style="font-size: 12pt;">{{$post->user->tag->name}}</span></h3>
                                    <small>{{$post->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                            <div>
                                <p style="margin: 0;">{{$post->caption}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection
