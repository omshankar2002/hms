@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Edit Booking #{{ $booking->booking_number }}</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Guest</label>
                            <input type="text" class="form-control" value="{{ $booking->guest->name }} — {{ $booking->guest->phone }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Room</label>
                            <select name="room_id" class="form-control select2">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                        Room {{ $room->room_number }} - {{ $room->roomType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check In <span class="text-danger">*</span></label>
                                    <input type="date" name="check_in" class="form-control" value="{{ old('check_in', $booking->check_in->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check Out <span class="text-danger">*</span></label>
                                    <input type="date" name="check_out" class="form-control" value="{{ old('check_out', $booking->check_out->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Adults</label>
                                    <input type="number" name="adults" class="form-control" value="{{ old('adults', $booking->adults) }}" min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Children</label>
                                    <input type="number" name="children" class="form-control" value="{{ old('children', $booking->children) }}" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Booking Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $booking->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status=='confirmed'?'selected':'' }}>Confirmed</option>
                                <option value="checked_in" {{ $booking->status=='checked_in'?'selected':'' }}>Checked In</option>
                                <option value="checked_out" {{ $booking->status=='checked_out'?'selected':'' }}>Checked Out</option>
                                <option value="cancelled" {{ $booking->status=='cancelled'?'selected':'' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Discount (₹)</label>
                            <input type="number" name="discount" class="form-control" value="{{ old('discount', $booking->discount) }}" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label>Special Requests</label>
                            <textarea name="special_requests" class="form-control" rows="3">{{ old('special_requests', $booking->special_requests) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Internal Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $booking->notes) }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Booking
                </button>
                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
