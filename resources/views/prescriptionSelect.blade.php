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
                <a href="{{ route('patient.select', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Select</a>
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
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td>{{date('Y-m-d',strtotime($row['created_at']))}}</td>
                        <td>{{$row['payment_type']}}</td>
                        <td>{{number_format($row['payment_amount'], 2, '.', ',')}}</td>
                        <td><a href="{{ route('payment.select', $row['id']) }}" class="btn btn-sm btn-outline-secondary">Select</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
