@extends('front.layouts.hotel')
@section('title', 'Book Your Room - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Book Your Room</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Book Now</li>
        </ul>
    </div>
</section>

<section style="padding:80px 0; background:#f8f5f0;">
<div class="auto-container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">

        <!-- Booking Form -->
        <div class="col-lg-8">

            <!-- Step 1: Dates & Room -->
            <div style="background:#fff; padding:35px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06); margin-bottom:25px;">
                <h4 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:25px;">
                    <span style="background:#c9a96e; color:#fff; width:28px; height:28px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-right:10px; font-size:14px;">1</span>
                    Select Dates & Check Availability
                </h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-weight:600; color:#333;">Check In Date</label>
                            <input type="date" id="checkInDate" class="form-control" value="{{ $checkIn }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-weight:600; color:#333;">Check Out Date</label>
                            <input type="date" id="checkOutDate" class="form-control" value="{{ $checkOut }}">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button id="checkAvailBtn" class="theme-btn btn-style-one w-100" style="border:none; padding:10px;">
                            <span class="btn-wrap">
                                <span class="text-one">Check Availability</span>
                                <span class="text-two">Check Availability</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Available Rooms -->
            <div id="availableRoomsSection" style="margin-bottom:25px; {{ $availableRooms ? '' : 'display:none;' }}">
                <div style="background:#fff; padding:35px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06);">
                    <h4 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:20px;">
                        <span style="background:#c9a96e; color:#fff; width:28px; height:28px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-right:10px; font-size:14px;">2</span>
                        Available Rooms
                    </h4>
                    <div id="roomsList">
                        @if($availableRooms && count($availableRooms) > 0)
                            @foreach($availableRooms as $room)
                            <div class="room-option" style="border:2px solid #eee; border-radius:6px; padding:20px; margin-bottom:15px; cursor:pointer; transition:all 0.3s;"
                                 onclick="selectRoom({{ $room->id }}, '{{ $room->roomType->name }}', {{ $room->roomType->base_price }}, this)">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 style="color:#1a1a2e; margin:0;">Room {{ $room->room_number }}</h5>
                                        <p style="color:#c9a96e; margin:5px 0 0; font-size:14px;">{{ $room->roomType->name }}</p>
                                        <small style="color:#666;">
                                            <i class="fa fa-user mr-1"></i>Max {{ $room->roomType->max_adults }} Adults
                                            <span class="mx-2">|</span>
                                            <i class="fa fa-child mr-1"></i>{{ $room->roomType->max_children }} Children
                                            @if($room->floor)
                                                <span class="mx-2">|</span>
                                                <i class="fa fa-building mr-1"></i>Floor: {{ $room->floor }}
                                            @endif
                                        </small>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="font-size:22px; font-weight:700; color:#c9a96e;">
                                            ₹{{ number_format($room->roomType->base_price, 0) }}
                                        </div>
                                        <small style="color:#666;">per night</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @elseif($availableRooms !== null)
                            <div class="text-center py-4">
                                <i class="fa fa-exclamation-circle fa-3x" style="color:#e74c3c; margin-bottom:10px; display:block;"></i>
                                <h5 style="color:#e74c3c;">No rooms available for selected dates.</h5>
                                <p style="color:#666;">Please try different dates.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Guest Details & Booking Form -->
            <form action="{{ route('front.storeBooking') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="room_id" id="selectedRoomId" value="{{ old('room_id') }}">
                <input type="hidden" name="check_in"  id="hiddenCheckIn"  value="{{ old('check_in', $checkIn) }}">
                <input type="hidden" name="check_out" id="hiddenCheckOut" value="{{ old('check_out', $checkOut) }}">

                <div style="background:#fff; padding:35px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06);">
                    <h4 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:25px;">
                        <span style="background:#c9a96e; color:#fff; width:28px; height:28px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-right:10px; font-size:14px;">3</span>
                        Your Details
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Full Name <span style="color:#e74c3c;">*</span></label>
                                <input type="text" name="guest_name" class="form-control" value="{{ old('guest_name') }}"
                                       placeholder="Your full name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Phone Number <span style="color:#e74c3c;">*</span></label>
                                <input type="text" name="guest_phone" class="form-control" value="{{ old('guest_phone') }}"
                                       placeholder="+91 XXXXX XXXXX" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Email Address</label>
                                <input type="email" name="guest_email" class="form-control" value="{{ old('guest_email') }}"
                                       placeholder="your@email.com">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Adults <span style="color:#e74c3c;">*</span></label>
                                <select name="adults" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2" selected>2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Children</label>
                                <select name="children" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label style="font-weight:600; color:#333;">Special Requests</label>
                                <textarea name="special_requests" class="form-control" rows="3"
                                          placeholder="Any special requests or preferences...">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div style="background:#f8f5f0; padding:15px; border-radius:6px; margin-bottom:20px;" id="priceSummary" style="display:none;">
                        <h6 style="color:#1a1a2e; margin-bottom:10px;">Booking Summary</h6>
                        <div class="d-flex justify-content-between" style="font-size:14px; color:#555;">
                            <span>Selected Room:</span><strong id="summaryRoom">—</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:14px; color:#555; margin-top:5px;">
                            <span>Nights:</span><strong id="summaryNights">—</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:14px; color:#555; margin-top:5px;">
                            <span>Room Total:</span><strong id="summaryRoomTotal">—</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:14px; color:#555; margin-top:5px;">
                            <span>GST (12%):</span><strong id="summaryTax">—</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:16px; color:#1a1a2e; border-top:1px solid #e0d9cf; margin-top:8px; padding-top:8px;">
                            <strong>Grand Total:</strong><strong id="summaryTotal" style="color:#c9a96e;">—</strong>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="theme-btn btn-style-one" style="border:none; padding:14px 40px;" disabled>
                        <span class="btn-wrap">
                            <span class="text-one">Confirm Booking <i class="fa-solid fa-arrow-right"></i></span>
                            <span class="text-two">Confirm Booking <i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </button>
                    <p style="color:#999; font-size:12px; margin-top:10px;">
                        <i class="fa fa-info-circle mr-1"></i> Please select a room from Step 2 before confirming.
                    </p>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div style="background:#1a1a2e; padding:30px; border-radius:8px; margin-bottom:25px; color:#fff;">
                <h5 style="color:#c9a96e; margin-bottom:20px;"><i class="fa fa-shield-alt mr-2"></i> Booking Policy</h5>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; color:#ccc;">
                    <li style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.1);">
                        <i class="fa fa-check" style="color:#c9a96e; margin-right:8px;"></i> Free cancellation up to 24h
                    </li>
                    <li style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.1);">
                        <i class="fa fa-check" style="color:#c9a96e; margin-right:8px;"></i> Pay at hotel
                    </li>
                    <li style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.1);">
                        <i class="fa fa-check" style="color:#c9a96e; margin-right:8px;"></i> Check-in from 2:00 PM
                    </li>
                    <li style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.1);">
                        <i class="fa fa-check" style="color:#c9a96e; margin-right:8px;"></i> Check-out until 11:00 AM
                    </li>
                    <li style="padding:8px 0;">
                        <i class="fa fa-check" style="color:#c9a96e; margin-right:8px;"></i> ID proof required at check-in
                    </li>
                </ul>
            </div>

            <div style="background:#f8f5f0; padding:25px; border-radius:8px; text-align:center;">
                <i class="fa fa-headset fa-2x" style="color:#c9a96e; margin-bottom:10px; display:block;"></i>
                <h6 style="color:#1a1a2e; margin-bottom:8px;">24/7 Support</h6>
                <p style="color:#666; font-size:13px; margin-bottom:12px;">Need help with your booking?</p>
                @isset($socialLink)
                    @if($socialLink->phone)
                        <a href="tel:{{ $socialLink->phone }}" style="color:#c9a96e; font-weight:700; text-decoration:none; font-size:16px;">
                            {{ $socialLink->phone }}
                        </a>
                    @endif
                    @if($socialLink->gmail)
                        <br><a href="mailto:{{ $socialLink->gmail }}" style="color:#666; font-size:13px; text-decoration:none;">
                            {{ $socialLink->gmail }}
                        </a>
                    @endif
                @endisset
            </div>

            <!-- Room Types Quick View -->
            <div style="background:#fff; padding:25px; border-radius:8px; margin-top:20px; box-shadow:0 3px 15px rgba(0,0,0,0.06);">
                <h6 style="color:#1a1a2e; margin-bottom:15px; border-bottom:2px solid #c9a96e; padding-bottom:8px;">Room Types</h6>
                @foreach($roomTypes as $rt)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid #f0ebe2; font-size:14px;">
                    <a href="{{ route('front.room-detail', $rt->slug) }}" style="color:#333; text-decoration:none;">{{ $rt->name }}</a>
                    <span style="color:#c9a96e; font-weight:600;">₹{{ number_format($rt->base_price, 0) }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
</section>

@endsection

@section('customJs')
<script>
let selectedPrice = 0;
let selectedRoomName = '';

// Check Availability
document.getElementById('checkAvailBtn').addEventListener('click', function() {
    const checkIn  = document.getElementById('checkInDate').value;
    const checkOut = document.getElementById('checkOutDate').value;

    if (!checkIn || !checkOut || checkIn >= checkOut) {
        alert('Please select valid check-in and check-out dates.');
        return;
    }

    document.getElementById('hiddenCheckIn').value  = checkIn;
    document.getElementById('hiddenCheckOut').value = checkOut;

    this.innerHTML = '<span class="btn-wrap"><span class="text-one"><i class="fa fa-spinner fa-spin mr-1"></i> Checking...</span><span class="text-two">Checking...</span></span>';

    fetch('{{ route("front.checkAvailability") }}?check_in=' + checkIn + '&check_out=' + checkOut, {
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(res => res.json())
    .then(rooms => {
        const section = document.getElementById('availableRoomsSection');
        const list    = document.getElementById('roomsList');
        section.style.display = 'block';

        if (!rooms.length) {
            list.innerHTML = `<div class="text-center py-4">
                <i class="fa fa-exclamation-circle fa-3x" style="color:#e74c3c; margin-bottom:10px; display:block;"></i>
                <h5 style="color:#e74c3c;">No rooms available for selected dates.</h5>
                <p style="color:#666;">Please try different dates.</p>
            </div>`;
        } else {
            list.innerHTML = rooms.map(room => `
                <div class="room-option" style="border:2px solid #eee; border-radius:6px; padding:20px; margin-bottom:15px; cursor:pointer; transition:all 0.3s;"
                     onclick="selectRoom(${room.id}, '${room.room_type ? room.room_type.name : 'Room'}', ${room.room_type ? room.room_type.base_price : 0}, this)">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 style="color:#1a1a2e; margin:0;">Room ${room.room_number}</h5>
                            <p style="color:#c9a96e; margin:5px 0 0; font-size:14px;">${room.room_type ? room.room_type.name : ''}</p>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:22px; font-weight:700; color:#c9a96e;">
                                ₹${room.room_type ? parseInt(room.room_type.base_price).toLocaleString() : '0'}
                            </div>
                            <small style="color:#666;">per night</small>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        this.innerHTML = '<span class="btn-wrap"><span class="text-one">Check Availability</span><span class="text-two">Check Availability</span></span>';
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    })
    .catch(() => {
        this.innerHTML = '<span class="btn-wrap"><span class="text-one">Check Availability</span><span class="text-two">Check Availability</span></span>';
        alert('Error checking availability. Please try again.');
    });
});

function selectRoom(roomId, roomName, price, el) {
    // Remove active from all
    document.querySelectorAll('.room-option').forEach(r => {
        r.style.border = '2px solid #eee';
        r.style.background = '#fff';
    });
    // Highlight selected
    el.style.border = '2px solid #c9a96e';
    el.style.background = '#fffdf5';

    document.getElementById('selectedRoomId').value = roomId;
    selectedPrice    = parseFloat(price);
    selectedRoomName = roomName;
    document.getElementById('submitBtn').disabled = false;

    // Update summary
    updateSummary();
    document.getElementById('priceSummary').style.display = 'block';
}

function updateSummary() {
    const checkIn  = new Date(document.getElementById('hiddenCheckIn').value);
    const checkOut = new Date(document.getElementById('hiddenCheckOut').value);
    const nights   = Math.max(1, (checkOut - checkIn) / (1000*60*60*24));
    const roomTotal= selectedPrice * nights;
    const tax      = roomTotal * 0.12;
    const grand    = roomTotal + tax;

    document.getElementById('summaryRoom').textContent      = selectedRoomName;
    document.getElementById('summaryNights').textContent    = nights + ' night(s)';
    document.getElementById('summaryRoomTotal').textContent = '₹' + roomTotal.toLocaleString('en-IN', {minimumFractionDigits:2});
    document.getElementById('summaryTax').textContent       = '₹' + tax.toLocaleString('en-IN', {minimumFractionDigits:2});
    document.getElementById('summaryTotal').textContent     = '₹' + grand.toLocaleString('en-IN', {minimumFractionDigits:2});
}
</script>
@endsection
