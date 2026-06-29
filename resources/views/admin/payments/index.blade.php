@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Payment Records</h1></div>
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
            <form method="GET" class="row">
                <div class="col-md-3">
                    <select name="method" class="form-control">
                        <option value="">All Methods</option>
                        <option value="cash" {{ request('method')=='cash'?'selected':'' }}>Cash</option>
                        <option value="card" {{ request('method')=='card'?'selected':'' }}>Card</option>
                        <option value="upi" {{ request('method')=='upi'?'selected':'' }}>UPI</option>
                        <option value="bank_transfer" {{ request('method')=='bank_transfer'?'selected':'' }}>Bank Transfer</option>
                        <option value="online" {{ request('method')=='online'?'selected':'' }}>Online</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="failed" {{ request('status')=='failed'?'selected':'' }}>Failed</option>
                        <option value="refunded" {{ request('status')=='refunded'?'selected':'' }}>Refunded</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Booking #</th>
                        <th>Guest</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Txn ID</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $pay)
                    <tr>
                        <td>{{ $pay->paid_at ? $pay->paid_at->format('d M Y H:i') : $pay->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('bookings.show', $pay->booking_id) }}">
                                <strong>{{ $pay->booking->booking_number }}</strong>
                            </a>
                        </td>
                        <td>{{ $pay->booking->guest->name }}</td>
                        <td><strong>₹{{ number_format($pay->amount, 2) }}</strong></td>
                        <td>{{ ucfirst(str_replace('_', ' ', $pay->method)) }}</td>
                        <td>{{ $pay->transaction_id ?? '—' }}</td>
                        <td>
                            @php $colors = ['completed'=>'success','pending'=>'warning','failed'=>'danger','refunded'=>'info']; @endphp
                            <span class="badge badge-{{ $colors[$pay->status] ?? 'secondary' }}">{{ ucfirst($pay->status) }}</span>
                        </td>
                        <td>
                            <form action="{{ route('payments.delete', $pay->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete this payment?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No payments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $payments->withQueryString()->links() }}</div>
    </div>
</div>
</section>
@endsection
