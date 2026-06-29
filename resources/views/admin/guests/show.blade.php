@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Guest Profile: {{ $guest->name }}</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-warning float-right ml-2">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('guests.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-5x text-muted mb-3"></i>
                    <h4>{{ $guest->name }}</h4>
                    <p class="text-muted">{{ $guest->nationality ?? 'Guest' }}</p>
                    <a href="{{ route('bookings.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i> New Booking
                    </a>
                </div>
                <div class="card-footer p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-phone mr-2 text-muted"></i> {{ $guest->phone }}</li>
                        @if($guest->email)<li class="list-group-item"><i class="fas fa-envelope mr-2 text-muted"></i> {{ $guest->email }}</li>@endif
                        @if($guest->gender)<li class="list-group-item"><i class="fas fa-venus-mars mr-2 text-muted"></i> {{ ucfirst($guest->gender) }}</li>@endif
                        @if($guest->dob)<li class="list-group-item"><i class="fas fa-birthday-cake mr-2 text-muted"></i> {{ $guest->dob->format('d M Y') }}</li>@endif
                        @if($guest->id_type)<li class="list-group-item"><i class="fas fa-id-card mr-2 text-muted"></i> {{ $guest->id_type }}: {{ $guest->id_number }}</li>@endif
                        @if($guest->address || $guest->city)
                        <li class="list-group-item">
                            <i class="fas fa-map-marker-alt mr-2 text-muted"></i>
                            {{ implode(', ', array_filter([$guest->address, $guest->city, $guest->country])) }}
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history mr-1"></i> Booking History ({{ $guest->bookings->count() }})</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr><th>Booking #</th><th>Room</th><th>Check In</th><th>Check Out</th><th>Amount</th><th>Status</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($guest->bookings as $booking)
                            @php $statusColors = ['pending'=>'warning','confirmed'=>'info','checked_in'=>'success','checked_out'=>'secondary','cancelled'=>'danger']; @endphp
                            <tr>
                                <td><strong>{{ $booking->booking_number }}</strong></td>
                                <td>{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td>
                                <td>{{ $booking->check_in->format('d M Y') }}</td>
                                <td>{{ $booking->check_out->format('d M Y') }}</td>
                                <td>₹{{ number_format($booking->grand_total, 2) }}</td>
                                <td><span class="badge badge-{{ $statusColors[$booking->status] ?? 'secondary' }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span></td>
                                <td><a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-3">No bookings yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
