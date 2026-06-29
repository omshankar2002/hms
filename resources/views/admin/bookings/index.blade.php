@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>All Bookings</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('bookings.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i> New Booking
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>
    @endif

    {{-- Filters --}}
    <div class="card card-outline card-secondary mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search booking/guest..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Confirmed</option>
                        <option value="checked_in" {{ request('status')=='checked_in'?'selected':'' }}>Checked In</option>
                        <option value="checked_out" {{ request('status')=='checked_out'?'selected':'' }}>Checked Out</option>
                        <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="payment_status" class="form-control">
                        <option value="">All Payments</option>
                        <option value="unpaid" {{ request('payment_status')=='unpaid'?'selected':'' }}>Unpaid</option>
                        <option value="partial" {{ request('payment_status')=='partial'?'selected':'' }}>Partial</option>
                        <option value="paid" {{ request('payment_status')=='paid'?'selected':'' }}>Paid</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}" placeholder="Check-in Date">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Booking #</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Nights</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    @php
                        $statusColors  = ['pending'=>'warning','confirmed'=>'info','checked_in'=>'success','checked_out'=>'secondary','cancelled'=>'danger'];
                        $payColors     = ['unpaid'=>'danger','partial'=>'warning','paid'=>'success'];
                    @endphp
                    <tr>
                        <td><strong>{{ $booking->booking_number }}</strong></td>
                        <td>
                            <strong>{{ $booking->guest->name }}</strong><br>
                            <small class="text-muted">{{ $booking->guest->phone }}</small>
                        </td>
                        <td>{{ $booking->room->room_number }} <br><small class="text-muted">{{ $booking->room->roomType->name }}</small></td>
                        <td>{{ $booking->check_in->format('d M Y') }}</td>
                        <td>{{ $booking->check_out->format('d M Y') }}</td>
                        <td>{{ $booking->nights }}</td>
                        <td>₹{{ number_format($booking->grand_total, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ $statusColors[$booking->status] ?? 'secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $payColors[$booking->payment_status] ?? 'secondary' }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-xs btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-xs btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('bookings.invoice', $booking->id) }}" class="btn btn-xs btn-secondary" title="Invoice" target="_blank">
                                <i class="fas fa-file-invoice"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center text-muted py-4">No bookings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $bookings->withQueryString()->links() }}
        </div>
    </div>
</div>
</section>
@endsection
