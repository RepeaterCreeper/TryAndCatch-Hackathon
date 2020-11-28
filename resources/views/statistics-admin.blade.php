@extends('layouts.app')
@section('content')
    @include('flash.message')
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="alert alert-danger m-2">
                <p style="margin: 0;"><b>Barangay Daan Pare</b> is currently experiencing power outage.</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-warning">
                <div class="card-body">
                    <div style="display: flex; align-items: center;">
                        <h4 class="text-dark" style="flex: 1;">ACTIVE CASES</h4>
                    </div>
                    <h1 class="text-dark" style="font-weight: bold;">{{$active != 0 ? '+'.$active:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-danger">
                <div class="card-body">
                    <div style="display: flex; align-items: center;">
                        <h4 class="text-white" style="flex: 1;">NEW COVID CASES</h4>
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#updateModal"><i class="fas fa-edit"></i> Update</button>
                    </div>
                    <h1 style="font-weight: bold; color: white;">{{$count != 0 ? '+'.$count:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-success">
                <div class="card-body">
                    <h4 class="text-white">RECOVERED COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">{{$recover != 0 ? '+'.$recover:'none'}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-dark">
                <div class="card-body">
                    <h4 class="text-white">TOTAL COVID CASES</h4>
                    <h1 style="font-weight: bold; color: white;">{{$total}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card shadow m-2 bg-primary">
                <div class="card-body">
                    <h4 class="text-white">REGISTERED POPULATION</h4>
                    <h1 style="font-weight: bold; color: white;">{{$population == 0 ? 'none': $population}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-6">
            <div class="card shadow m-2 border-primary">
                <div class="card-body">
                    <h1>Power Outage Reports</h1>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Citizen ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Report Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">00-0001</th>
                            <td>Joseph Chua</td>
                            <td>JavaScript, Void</td>
                            <td>11/28/2020 08:00:54 am</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

{{--    Modal   --}}
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Choose an action</h5>
                    <button type="button" class="close" onclick="resetLabel()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a class="btn btn-primary" href="{{route('covid.add.view')}}" id="addNewBtn">Add new case</a>
                    <a class="btn btn-outline-primary" href="{{route('covid.update.view')}}" id="updateBtn">Update Recoveries</a>
                  {{--  <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="resetLabel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
