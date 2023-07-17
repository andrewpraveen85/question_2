@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 bpatient-bottom">
        <h1 class="h2">Patient</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('patient.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
                @if($patient->patient_status ==true)
                    <a href="{{ route('patient.update', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                @endif
            </div>
        </div>
    </div>
    <h2>View</h2>
    <div class="row">
        <div class="col-md-2">#</div>
        <div class="col-md-2">{{$patient->id}}</div>
        <div class="col-md-4"><img src="{{ asset('storage/images/'.$patient->patient_photo) }}" class="img-thumbnail" style="max-width:50px;"></div>
        <div class="col-md-2">Status</div>
        @if($patient->patient_status ==true)
            <div class="col-md-2">Active</div>
        @else
            <div class="col-md-2">Inactive</div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-2">Name</div>
        <div class="col-md-2">{{$patient->patient_name}}</div>
        <div class="col-md-2">NIC</div>
        <div class="col-md-2">{{$patient->patient_nic}}</div>
        <div class="col-md-2">DOB</div>
        <div class="col-md-2">{{$patient->patient_dob}}</div>
    </div>
    <div class="row">
        <div class="col-md-2">Tell</div>
        <div class="col-md-2">{{$patient->patient_tell}}</div>
        <div class="col-md-2">Notes</div>
        <div class="col-md-6">{{$patient->patient_notes}}</div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 bpatient-bottom">
        <h2>Prescriptions</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @if($patient->patient_status ==true)
                    <a href="{{ route('prescription.insert', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Insert</a>
                @endif
                @if($prescription->prescription_status ==true)
                    <a href="{{ route('prescription.update', $prescription->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Date</div>
        <div class="col-md-2">{{$prescription->prescription_date}}</div>
        <div class="col-md-2">Price</div>
        <div class="col-md-2">{{number_format($prescription->prescription_price, 2, '.', ',')}}</div>
        <div class="col-md-2">Status</div>
        @if($prescription->prescription_status ==true)
            <div class="col-md-2">Active</div>
        @else
            <div class="col-md-2">Inactive</div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-2">Prescription</div>
        <div class="col-md-10">{{$prescription->prescription_description}}</div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 bpatient-bottom">
        <h2>Payments</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @if($prescription->prescription_status ==true)
                    <a href="{{ route('payment.insert', $prescription->id) }}" class="btn btn-sm btn-outline-secondary">Insert</a>
                @endif
            </div>
        </div>
    </div>
    <h2>Create</h2>
    <form method="POST" action="{{ route('payment.insert.confirm') }}" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <input type="hidden" name=prescription_id value='{{$prescription->id}}'>
        <div class="form-floating mb-3">
            <input type="number" step="100" min="100" class="form-control" id="floatingInput" name="payment_amount" placeholder="payment_amount" value="" required>
            <label for="floatingInput">payment_amount</label>
            @if ($errors->has('payment_amount'))
                <span class="text-danger">{{$errors->first('payment_amount')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="menu" name="payment_type" required>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
            <label for="floatingInput">payment_type</label>
            @if ($errors->has('payment_type'))
                <span class="text-danger">{{$errors->first('payment_type')}}</span>
            @endif
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Insert</button>
    </form>
@endsection
