@extends('admin.layouts.app')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Appointment Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.appointments') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ $appointment->name }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $appointment->email }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" value="{{ $appointment->phone }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="service">Service</label>
                        <input type="text" class="form-control" id="service" value="{{ $appointment->service }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" id="date" value="{{ $appointment->created_at->format('d-m-Y h:i A') }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="preferred_time">Preferred Time</label>
                        <ul class="list-group">
                            @foreach($appointment->contact_time as $time)
                                <li class="list-group-item">{{ $time }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="message">Message</label>
                        <textarea class="form-control" rows="10" readonly>{{ $appointment->message }}</textarea>
                    </div>
                </div>
            </div>							
        </div>
    </div>
</section>
@endsection
