@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div style="height: 80vh; width: 100vw;" class="bg-dark d-flex flex-column align-items-center justify-content-center">
       <div class="w-50">
           @foreach ($messages as $message)
               <a href="{{route('chatroom',$message[0]->user_id)}}" class="alert alert-primary d-block text-decoration-none">
                    {{$message[0]->email}}
               </a>
           @endforeach
       </div>
    </div>
@endsection
