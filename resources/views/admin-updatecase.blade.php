@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 70vh">
        <h2 class="text-center">These are the list of active cases</h2>
        @include('flash.message')
        <table class="table w-75" >
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($cases as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->address}}</td>
                    <td class="d-flex">
                        <form action="{{route('covid.update.recover')}}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button class="btn btn-success ml-2"><i class="fas fa-check"></i> Recovered</button>
                        </form>

                        <form action="{{route('covid.update.deceased')}}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button class="btn btn-dark ml-2"><i class="fas fa-skull-crossbones"></i> Deceased</button>
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
@endsection
