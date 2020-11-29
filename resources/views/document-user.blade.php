@extends('layouts.app')
@section('content')
    @include('flash.message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <h2>We encountered some errors while processing your request</h2>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('simple.document.store')}}" method="post" class="row no-gutters">
        <div class="col col-sm-12">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Hi, John</h3>
                    <p>What kind of documents do you need?</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Document Selection</label>
                        <select class="form-control" name="type" id="document-selection">
                            <option default selected disabled>Please select a document...</option>
                            <option value="certresidency">Certificate of Residency</option>
                            <option value="certvalidid">Certificate of Valid ID</option>
                            <option value="certguardianship">Certification of Guardianship</option>
                            <option value="brgclearance">Barangay Clearance</option>
                            <option value="brgclearance_installation">Barangay Clearance for Installation</option>
                            <option value="brgclearance_businesspermit">Barangay Clearance for Business Permit Application</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-12">
            <div class="card shadow m-2">
                <div class="card-header">
                    <h3>Document Preview - <span>Barangay Clearance</span></h3>
                    <p>This is the form you need to fill out to request for the selected document.</p>
                </div>
                <div class="card-body">
                    <div >
                        @csrf
                        <div data-id="document-data">
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label for="purpose_requests">Purpose of Request</label>
                                <input type="text" class="form-control" placeholder="Purpose of Requests"
                                       name="purpose" id="purpose_requests">
                            </div>
                        </div>
                        <div class="form-row">
                            <button class="btn btn-success" type="submit">Submit Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')

    <script>
        document.querySelector("#document-selection").addEventListener("change", function (e) {
            let value = e.srcElement.value;

            let documents = {
                "certresidency": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`,
                "certvalidid": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`,
                "certguardianship": `<div class="form-row"> <div class="form-group col-sm-10"> <label for="guardian_name">Guardian Name</label> <input type="text" class="form-control" name="guardian_name" id="guardian_name" placeholder="Guardian Name"> </div></div><div class="form-row"> <div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="guardian_name" placeholder="Full Name"> </div></div>`,
                "brgclearance": `<div class="form-row">
                    <div class="form-group col-sm-1"><label for="suffix">Suffix</label><select class="form-control"
                            name="title" id="suffix">
                            <option value="Mr">Mr.</option>
                            <option value="Ms">Ms.</option>
                            <option value="Mrs">Mrs.</option>
                        </select> </div>
                    <div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text"
                            class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div>
                    <div class="form-group col-sm-1"> <label for="civil_status">Civil Status</label> <select
                            name="civil_status" class="form-control" id="civil_status">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select> </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6"> <label for="age">Age</label> <input type="number"
                            class="form-control" placeholder="Age" name="age" id="age"> </div>
                    <div class="form-group col-sm-6"> <label for="residence-number">Residence Number</label> <input
                            type="number" class="form-control" placeholder="Residence Number" name="residence_number"
                            id="residence-number"> </div>
                </div>`,
                "brgclearance_businesspermit": `<div class="form-row"> <div class="form-group col-sm-12"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div><div class="form-group col-sm-12"> <label for="contact_no">Contact No.</label> <input type="text" class="form-control" name="contact_number" id="contact_no" placeholder="Contact No."> </div><div class="form-group col-sm-12"> <label for="business_type">Type of Business</label> <input type="text" class="form-control" name="business_type" id="business_type" placeholder="Business Type"> </div><div class="form-group col-sm-12"> <label for="business_location">Business Location</label> <input type="text" class="form-control" name="business_location" id="business_location" placeholder="Business Location"> </div><div class="form-group col-sm-12"> <div class="custom-file"> <input type="file" name="business_location_sketch" class="custom-file-input" id="business_location_sketch"> <label class="custom-file-label" for="business_location_sketch">Attach Sketch Map</label> </div></div><div class="form-group col-sm-12"> <div class="form-group" data-id="business_ownership"> <label for="business_ownership">Business Ownership</label> <select class="form-control" id="business_ownership" name="business_ownership"> <option value="rented">Rented</option> <option value="owned">Owned</option> <option value="others">Others Specify</option> </select> </div><div class="form-group" data-id="business_ownership_other"> <label for="business_ownership_other">Business Ownership Other (optional if RENTED or OWNED):</label> <input type="text" class="form-control" name="business_ownership_other" id="business_ownership_other"> </div></div></div><div class="form-row"> <div class="form-group col-sm-6"> <label for="age">Comm Tax Cert. No. (Cedula)</label> <input type="number" class="form-control" placeholder="Age" name="age" id="age"> </div><div class="form-group col-sm-6"> <label for="residence_number">Residence Number</label> <input type="number" class="form-control" placeholder="Residence Number" name="residence_number" id="residence-number"> </div></div>`,
                "brgclearance_installation": `<div class="form-row"><div class="form-group col-sm-10"> <label for="full_name">Full Name</label> <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"> </div> </div>`
            };

            document.querySelector("*[data-id='document-data']").innerHTML = documents[value];
        });

    </script>
@endpush
