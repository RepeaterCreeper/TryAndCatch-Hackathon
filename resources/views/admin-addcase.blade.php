@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center align-items-center flex-column" style="height: 60vh; width: 100vw; background-color: #95c5ed">
        <h1 style="margin:0;background-color: #1d68a7;color: #fff;width: 50vw;border-top-left-radius: 15px;border-top-right-radius: 15px;box-shadow: #5a6268 1.5px 0 0 0;" class="p-3 d-flex justify-content-center align-items-center flex-column"" >Add new COVID case</h1>
        <div class="container d-flex flex-column align-items-center mt-0" style="background-color: #d6e9f8;border-bottom-left-radius: 15px;border-bottom-right-radius: 15px; width: 50vw;box-shadow: #5a6268 1.5px 1.5px;">
            <form action="{{route('covid.new')}}" class="w-50" id="addNewForm" method="post">
                @include('flash.message')
                @csrf
                <input type="text" name="first_name" class="form-control mt-5 @error('first_name') is-invalid @enderror" placeholder="First name">
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
                <input type="submit" class="btn btn-block btn-primary mt-4 mb-5" value="Submit">
            </form>
        </div>



    </div>
@endsection
