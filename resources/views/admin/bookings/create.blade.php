@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>New Booking</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
        @csrf
        <div class="row">
            {{-- Guest Info --}}
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-user mr-1"></i> Guest Information</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Search Existing Guest</label>
                            <input type="text" id="guestSearch" class="form-control" placeholder="Search by name or phone...">
                            <div id="guestSuggestions" class="list-group mt-1" style="position:absolute;z-index:999;width:95%;display:none;"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Guest Name <span class="text-danger">*</span></label>
                                    <input type="text" name="guest_name" id="guestName" class="form-control" value="{{ old('guest_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="guest_phone" id="guestPhone" class="form-control" value="{{ old('guest_phone') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="guest_email" id="guestEmail" class="form-control" value="{{ old('guest_email') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Adults <span class="text-danger">*</span></label>
                                    <input type="number" name="adults" class="form-control" value="{{ old('adults', 1) }}" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Children</label>
                                    <input type="number" name="children" class="form-control" value="{{ old('children', 0) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Source <span class="text-danger">*</span></label>
                                    <select name="source" class="form-control">
                                        <option value="walk_in" {{ old('source')=='walk_in'?'selected':'' }}>Walk In</option>
                                        <option value="online" {{ old('source')=='online'?'selected':'' }}>Online</option>
                                        <option value="phone" {{ old('source')=='phone'?'selected':'' }}>Phone</option>
                                        <option value="travel_agent" {{ old('source')=='travel_agent'?'selected':'' }}>Travel Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Special Requests</label>
                            <textarea name="special_requests" class="form-control" rows="2" placeholder="Any special requests...">{{ old('special_requests') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Room & Dates --}}
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-bed mr-1"></i> Room & Dates</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check In <span class="text-danger">*</span></label>
                                    <input type="date" name="check_in" id="checkIn" class="form-control"
                                           value="{{ old('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check Out <span class="text-danger">*</span></label>
                                    <input type="date" name="check_out" id="checkOut" class="form-control"
                                           value="{{ old('check_out', date('Y-m-d', strtotime('+1 day'))) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Select Room <span class="text-danger">*</span></label>
                            <select name="room_id" id="roomSelect" class="form-control select2" required>
                                <option value="">-- Select Room --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" data-price="{{ $room->roomType->base_price }}"
                                            {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        Room {{ $room->room_number }} - {{ $room->roomType->name }} (₹{{ number_format($room->roomType->base_price, 2) }}/night)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="confirmed" {{ old('status','confirmed')=='confirmed'?'selected':'' }}>Confirmed</option>
                                        <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Pending</option>
                                        <option value="checked_in" {{ old('status')=='checked_in'?'selected':'' }}>Check In Now</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount (₹)</label>
                                    <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', 0) }}" min="0" step="0.01">
                                </div>
                            </div>
                        </div>

                        {{-- Price Summary --}}
                        <div class="card bg-light">
                            <div class="card-body py-2">
                                <table class="table table-sm mb-0">
                                    <tr><td>Nights</td><td class="text-right" id="nightsDisplay">0</td></tr>
                                    <tr><td>Room Rate/Night</td><td class="text-right" id="rateDisplay">₹0.00</td></tr>
                                    <tr><td>Room Total</td><td class="text-right" id="roomTotalDisplay">₹0.00</td></tr>
                                    <tr><td>Discount</td><td class="text-right text-danger" id="discountDisplay">-₹0.00</td></tr>
                                    <tr><td>GST (12%)</td><td class="text-right" id="taxDisplay">₹0.00</td></tr>
                                    <tr class="table-success"><td><strong>Grand Total</strong></td><td class="text-right"><strong id="grandTotalDisplay">₹0.00</strong></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-lg">
            <i class="fas fa-check-circle mr-1"></i> Create Booking
        </button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary btn-lg ml-2">Cancel</a>
    </form>
</div>
</section>
@endsection

@section('customJs')
<script>
// Guest search
let searchTimer;
$('#guestSearch').on('input', function() {
    clearTimeout(searchTimer);
    const q = $(this).val();
    if (q.length < 2) { $('#guestSuggestions').hide(); return; }
    searchTimer = setTimeout(() => {
        $.get('{{ route("guests.search") }}', { q }, function(data) {
            const box = $('#guestSuggestions').empty().show();
            if (!data.length) { box.append('<a class="list-group-item">No guests found</a>'); return; }
            data.forEach(g => {
                box.append(`<a href="#" class="list-group-item list-group-item-action guest-item"
                    data-name="${g.name}" data-phone="${g.phone}" data-email="${g.email || ''}">
                    <strong>${g.name}</strong> — ${g.phone}</a>`);
            });
        });
    }, 300);
});

$(document).on('click', '.guest-item', function(e) {
    e.preventDefault();
    $('#guestName').val($(this).data('name'));
    $('#guestPhone').val($(this).data('phone'));
    $('#guestEmail').val($(this).data('email'));
    $('#guestSearch').val($(this).data('name'));
    $('#guestSuggestions').hide();
});

// Price calculation
function calcTotal() {
    const checkIn  = new Date($('#checkIn').val());
    const checkOut = new Date($('#checkOut').val());
    const nights   = Math.max(0, (checkOut - checkIn) / (1000*60*60*24));
    const rate     = parseFloat($('#roomSelect option:selected').data('price')) || 0;
    const discount = parseFloat($('#discount').val()) || 0;
    const roomTotal = rate * nights;
    const subtotal  = roomTotal - discount;
    const tax       = subtotal > 0 ? subtotal * 0.12 : 0;
    const grand     = subtotal + tax;

    $('#nightsDisplay').text(nights);
    $('#rateDisplay').text('₹' + rate.toFixed(2));
    $('#roomTotalDisplay').text('₹' + roomTotal.toFixed(2));
    $('#discountDisplay').text('-₹' + discount.toFixed(2));
    $('#taxDisplay').text('₹' + tax.toFixed(2));
    $('#grandTotalDisplay').text('₹' + grand.toFixed(2));
}

$('#checkIn, #checkOut, #roomSelect, #discount').on('change input', calcTotal);
calcTotal();
</script>
@endsection
