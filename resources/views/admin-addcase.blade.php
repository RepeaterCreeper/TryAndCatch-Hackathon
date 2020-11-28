@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center align-items-center flex-column" style="height: 80vh; width: 100vw;">
        <h1>Add new case</h1>
        <form action="{{route('covid.new')}}" class="w-75" id="addNewForm" method="post">
            @include('flash.message')
            @csrf
            <input type="text" name="first_name" class="form-control mt-2 @error('first_name') is-invalid @enderror" placeholder="First name">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <input type="text" name="last_name" class="form-control mt-2  @error('last_name') is-invalid @enderror" placeholder="Last name">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
            <input type="text" name="mobile_number" class="form-control mt-2 @error('mobile_number') is-invalid @enderror" placeholder="Mobile Number">
            @error('mobile_number')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
            <input type="text" name="address" class="form-control mt-2 @error('address') is-invalid @enderror" placeholder="Address">
            @error('address')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
            <input type="submit" class="btn btn-primary mt-4" value="Submit">
        </form>
    </div>
@endsection
