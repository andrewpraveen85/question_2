@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('patient.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
            </div>
        </div>
    </div>
    <h2>Patients</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($patient as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td><img src="{{ asset('storage/images/'.$row['patient_photo']) }}" class="img-thumbnail" style="max-width:50px;"></td>
                        <td>{{$row['patient_name']}}</td>
                        <td>{{$row['patient_nic']}}</td>
                        @if($row['patient_status'] ==true)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td><a href="{{ route('patient.select', $row['id']) }}" class="btn btn-sm btn-outline-secondary">Select</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
