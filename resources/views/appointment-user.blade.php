@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col col-sm-8">
            <form class="card shadow m-2" action="{{route('user.appointnment.store')}}" method="post">
                @csrf
                <div class="card-header">
                    <h1 style="margin-bottom: 0;">Request for an Appointment</h1>
                    <p class="lead">You can request for an appointment, but the time and date set is NOT guaranteed.
                        This is up to the Admin's discretion.</p>
                </div>
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <label for="appointment_date" class="col-md-12">{{ __('Appointment Date') }}</label>
                            <div class="col-md-12">
                                <input type="date" class="form-control is-invalid" name="date"
                                       autocomplete="date" autofocus>
                                @error('appointment_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="appointment_time" class="col-md-12">{{ __('Appointment Time') }}</label>
                            <div class="col-md-12">
                                <input type="time" class="form-control is-invalid" name="time"
                                       autocomplete="appointment_time" autofocus>
                                @error('appointment_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success float-right">Submit Request</button>
                </div>
            </form>
        </div>
        <div class="col col-sm-4">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Pending Appointments</h3>
                    <p>These are all your pending appointments.</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse ($data as $i => $d)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{\Carbon\Carbon::parse($d->schedule)->toDateTime()->format('Y m d')}}</td>
                                <td>{{\Carbon\Carbon::parse($d->schedule)->toDateTime()->format("g:i A")}}</td>
                                <td><span class="badge badge-primary text-white">{{ucwords($d->status)}}</span></td>
                            </tr>
                        @empty

                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
