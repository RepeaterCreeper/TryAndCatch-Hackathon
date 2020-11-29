@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Need help? Chat with an Admin</h3>
                    <p>Type in your question and an admin will contact you as soon as one is available.</p>
                </div>
                <div class="card-body">
                    <div>
                        <button class="btn btn-primary">Ask for Status</button>
                        <button class="btn btn-info">Other Concerns</button>
                    </div>
                    <div class="card my-4 border-primary">

                        @foreach($messages as $message)
                            @if ($message->user->email == auth()->user()->email)
                                <div class="chat-self p-4" style="display: flex; justify-content: flex-end;">
                                    <div style="display: flex; gap: 16px; align-items: center; flex-direction: row-reverse;">
                                        <div class="rounded-circle"
                                             style="width: 64px; height: 64px; background-color: pink; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 1.5rem; color: white;">
                                            <span>{{ucfirst($message->user->first_name[0])}}</span>
                                        </div>
                                        <div style="display: flex; flex-direction: column; text-align: right;">
                                            <p style="margin: 0;">{{$message->user->first_name." ".$message->user->last_name}}</p>
                                            <div class="bg-info rounded" style="min-width: 300px; padding: 8px; color: white;">
                                                <p>{{$message->message}}</p>
                                                <small class="grey-text float-left">{{$message->created_at->toDayDateTimeString()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="chat-self p-4" style="display: flex;">
                                    <div style="display: flex; gap: 16px; align-items: center;">
                                        <div class="rounded-circle"
                                             style="width: 64px; height: 64px; background-color: blue; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 1.5rem; color: white;">
                                            <span>{{ucfirst($message->user->first_name[0])}}</span>
                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <p style="margin: 0;">{{$message->user->first_name." ".$message->user->last_name}}</p>
                                            <div class="bg-primary rounded"
                                                 style="min-width: 300px; padding: 8px; color: white;">
                                                <p>{{$message->message}}</p>
                                                <small class="grey-text float-left">{{$message->created_at->toDayDateTimeString()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="card-footer" id="here">
                            <form class="input-group mb-3" action="{{route('admin.store',$message->user_id)}}" method="post">
                                @method('patch')
                                @csrf
                                <input type="text" class="form-control @error('message') is-invalid @enderror @if(session('success')) is-valid @endif" name="message" placeholder="Your message..."
                                       aria-label="Your message..." aria-describedby="send_message">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit"
                                            id="send_message"><i class="fas fa-paper-plane"></i> Send</button>
                                </div>
                                @if (session('success'))
                                    <span class="valid-feedback" role="alert">
                                    <strong>{{ session()->get('success') }}</strong>
                                </span>
                                @endif
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
