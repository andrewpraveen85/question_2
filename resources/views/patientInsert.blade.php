@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Patient</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('patient.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
            </div>
        </div>
    </div>
    <h2>Create</h2>
    <form method="POST" action="{{ route('patient.insert.confirm') }}" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="patient_nic" placeholder="patient_nic" value="" required>
            <label for="floatingInput">patient_nic</label>
            @if ($errors->has('patient_nic'))
                <span class="text-danger">{{$errors->first('patient_nic')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="patient_name" placeholder="patient_name" value="" required>
            <label for="floatingInput">patient_name</label>
            @if ($errors->has('patient_name'))
                <span class="text-danger">{{$errors->first('patient_name')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" name="patient_dob" placeholder="patient_dob" value="" required>
            <label for="floatingInput">patient_dob</label>
            @if ($errors->has('patient_dob'))
                <span class="text-danger">{{$errors->first('patient_dob')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="patient_tell" placeholder="patient_tell" value="" required>
            <label for="floatingInput">patient_tell</label>
            @if ($errors->has('patient_tell'))
                <span class="text-danger">{{$errors->first('patient_tell')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="floatingInput" name="patient_photo" placeholder="patient_photo" value="" required>
            <label for="floatingInput">patient_photo</label>
            @if ($errors->has('patient_photo'))
                <span class="text-danger">{{$errors->first('patient_photo')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="patient_notes" placeholder="patient_notes" value="" required>
            <label for="floatingInput">patient_notes</label>
            @if ($errors->has('patient_notes'))
                <span class="text-danger">{{$errors->first('patient_notes')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="menu" name="patient_status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <label for="floatingInput">patient_status</label>
            @if ($errors->has('patient_status'))
                <span class="text-danger">{{$errors->first('patient_status')}}</span>
            @endif
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Insert</button>
    </form>
@endsection
