@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Booking #{{ $booking->booking_number }}</h1></div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('bookings.invoice', $booking->id) }}" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-file-invoice mr-1"></i> Invoice
                </a>
                <a href="{{ route('bookings.index') }}" class="btn btn-default">
                    <i class="fas fa-arrow-left mr-1"></i> Back
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
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- Booking Details --}}
        <div class="col-md-8">

            {{-- Status Bar --}}
            <div class="card">
                <div class="card-body py-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @php $statusColors = ['pending'=>'warning','confirmed'=>'info','checked_in'=>'success','checked_out'=>'secondary','cancelled'=>'danger']; @endphp
                            <span class="badge badge-{{ $statusColors[$booking->status] ?? 'secondary' }} p-2" style="font-size:14px;">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                        <div class="col-auto">
                            @php $payColors = ['unpaid'=>'danger','partial'=>'warning','paid'=>'success']; @endphp
                            <span class="badge badge-{{ $payColors[$booking->payment_status] ?? 'secondary' }} p-2" style="font-size:14px;">
                                Payment: {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>
                        <div class="col text-right text-muted small">
                            Created: {{ $booking->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Guest & Room Info --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title"><i class="fas fa-user mr-1"></i> Guest Details</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ $booking->guest->name }}</p>
                            <p><strong>Phone:</strong> {{ $booking->guest->phone }}</p>
                            <p><strong>Email:</strong> {{ $booking->guest->email ?? '—' }}</p>
                            <p><strong>Nationality:</strong> {{ $booking->guest->nationality ?? '—' }}</p>
                            <p><strong>ID:</strong> {{ $booking->guest->id_type }} {{ $booking->guest->id_number }}</p>
                            <a href="{{ route('guests.show', $booking->guest_id) }}" class="btn btn-sm btn-info">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title"><i class="fas fa-bed mr-1"></i> Room Details</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Room:</strong> {{ $booking->room->room_number }} (Floor: {{ $booking->room->floor ?? 'N/A' }})</p>
                            <p><strong>Type:</strong> {{ $booking->room->roomType->name }}</p>
                            <p><strong>Check In:</strong> {{ $booking->check_in->format('d M Y') }}</p>
                            <p><strong>Check Out:</strong> {{ $booking->check_out->format('d M Y') }}</p>
                            <p><strong>Nights:</strong> {{ $booking->nights }} | <strong>Adults:</strong> {{ $booking->adults }} | <strong>Children:</strong> {{ $booking->children }}</p>
                            <p><strong>Source:</strong> {{ ucfirst(str_replace('_', ' ', $booking->source)) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Special Requests --}}
            @if($booking->special_requests)
            <div class="card">
                <div class="card-header"><h3 class="card-title">Special Requests</h3></div>
                <div class="card-body"><p>{{ $booking->special_requests }}</p></div>
            </div>
            @endif

            {{-- Services --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-concierge-bell mr-1"></i> Services</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr><th>Service</th><th>Category</th><th>Qty</th><th>Unit Price</th><th>Total</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($booking->bookingServices as $bs)
                            <tr>
                                <td>{{ $bs->hotelService->name }}</td>
                                <td><span class="badge badge-info">{{ $bs->hotelService->category }}</span></td>
                                <td>{{ $bs->quantity }}</td>
                                <td>₹{{ number_format($bs->unit_price, 2) }}</td>
                                <td>₹{{ number_format($bs->total_price, 2) }}</td>
                                <td>
                                    <form action="{{ route('bookings.removeService', $bs->id) }}" method="POST" onsubmit="return confirm('Remove service?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs btn-danger"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted">No services added.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <form action="{{ route('bookings.addService', $booking->id) }}" method="POST" class="form-inline">
                        @csrf
                        <select name="hotel_service_id" class="form-control form-control-sm mr-2" required>
                            <option value="">-- Add Service --</option>
                            @foreach($hotelServices as $svc)
                                <option value="{{ $svc->id }}">{{ $svc->name }} (₹{{ $svc->price }}/{{ $svc->unit }})</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantity" class="form-control form-control-sm mr-2" value="1" min="1" style="width:70px;">
                        <button class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Add</button>
                    </form>
                </div>
            </div>

            {{-- Payments --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-credit-card mr-1"></i> Payments</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr><th>Date</th><th>Amount</th><th>Method</th><th>Txn ID</th><th>Status</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($booking->payments as $pay)
                            <tr>
                                <td>{{ $pay->paid_at ? $pay->paid_at->format('d M Y H:i') : '—' }}</td>
                                <td>₹{{ number_format($pay->amount, 2) }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $pay->method)) }}</td>
                                <td>{{ $pay->transaction_id ?? '—' }}</td>
                                <td><span class="badge badge-success">{{ ucfirst($pay->status) }}</span></td>
                                <td>
                                    <form action="{{ route('payments.delete', $pay->id) }}" method="POST" onsubmit="return confirm('Delete this payment?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted">No payments recorded.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <form action="{{ route('payments.store') }}" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="number" name="amount" class="form-control form-control-sm mr-2" placeholder="Amount" min="0.01" step="0.01"
                               value="{{ $booking->amount_due > 0 ? $booking->amount_due : '' }}" style="width:110px;" required>
                        <select name="method" class="form-control form-control-sm mr-2" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="upi">UPI</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="online">Online</option>
                        </select>
                        <input type="text" name="transaction_id" class="form-control form-control-sm mr-2" placeholder="Txn ID" style="width:120px;">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i> Record Payment</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Billing Summary --}}
        <div class="col-md-4">
            <div class="card card-success">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title"><i class="fas fa-receipt mr-1"></i> Billing Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr><td>Room ({{ $booking->nights }} nights × ₹{{ number_format($booking->room_rate, 2) }})</td><td class="text-right">₹{{ number_format($booking->room_total, 2) }}</td></tr>
                        <tr><td>Services Total</td><td class="text-right">₹{{ number_format($booking->services_total, 2) }}</td></tr>
                        <tr><td class="text-danger">Discount</td><td class="text-right text-danger">-₹{{ number_format($booking->discount, 2) }}</td></tr>
                        <tr><td>GST (12%)</td><td class="text-right">₹{{ number_format($booking->tax, 2) }}</td></tr>
                        <tr class="table-dark"><td><strong>Grand Total</strong></td><td class="text-right"><strong>₹{{ number_format($booking->grand_total, 2) }}</strong></td></tr>
                        <tr class="table-success"><td>Amount Paid</td><td class="text-right text-success">₹{{ number_format($booking->amount_paid, 2) }}</td></tr>
                        @if($booking->amount_due > 0)
                        <tr class="table-danger"><td><strong>Amount Due</strong></td><td class="text-right text-danger"><strong>₹{{ number_format($booking->amount_due, 2) }}</strong></td></tr>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Notes --}}
            @if($booking->notes)
            <div class="card">
                <div class="card-header"><h3 class="card-title">Internal Notes</h3></div>
                <div class="card-body"><p class="text-muted">{{ $booking->notes }}</p></div>
            </div>
            @endif
        </div>
    </div>

</div>
</section>
@endsection
