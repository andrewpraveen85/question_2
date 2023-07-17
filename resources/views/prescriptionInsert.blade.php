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
            </div>
        </div>
    </div>
    <h2>Create</h2>
    <form method="POST" action="{{ route('prescription.insert.confirm') }}" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" name="prescription_date" placeholder="prescription_date" value="" required>
            <label for="floatingInput">prescription_date</label>
            @if ($errors->has('prescription_date'))
                <span class="text-danger">{{$errors->first('prescription_date')}}</span>
            @endif
        </div>
        <input type="hidden" name=patient_id value='{{$patient->id}}'>
        <div class="form-floating mb-3">
            <textarea type="text" class="form-control" id="floatingInput" name="prescription_description" placeholder="prescription_description" value="" required></textarea>
            <label for="floatingInput">prescription_description</label>
            @if ($errors->has('prescription_description'))
                <span class="text-danger">{{$errors->first('prescription_description')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="100" min="100" class="form-control" id="floatingInput" name="prescription_price" placeholder="prescription_price" value="" required>
            <label for="floatingInput">prescription_price</label>
            @if ($errors->has('prescription_price'))
                <span class="text-danger">{{$errors->first('prescription_price')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="menu" name="prescription_status" required>
                <option value="1">Active</option>
            </select>
            <label for="floatingInput">prescription_status</label>
            @if ($errors->has('prescription_status'))
                <span class="text-danger">{{$errors->first('prescription_status')}}</span>
            @endif
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Insert</button>
    </form>
@endsection
