@extends('layouts.admin')

@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center mt-auto" style="height: 94.2vh;">
        <div class="w-75">
            <h2>{{$user->first_name." ". $user->last_name}}</h2>
            <h4>{{$user->address}}</h4>
        </div>
        <div class="w-75">
            <img src="{{asset('storage/images/'.$user->email."/".$user->valid_id)}}" alt="" class="img-thumbnail">
        </div>
        <div class="actions mt-2 w-75 d-flex justify-content-end">
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
        </div>
    </div>
@endsection
