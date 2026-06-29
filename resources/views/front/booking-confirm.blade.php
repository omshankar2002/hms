@extends('front.layouts.hotel')
@section('title', 'Booking Confirmed - Grand Hotel')

@section('content')

<section style="padding:100px 0; background:#f8f5f0; min-height:70vh;">
<div class="auto-container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div style="background:#fff; padding:50px; border-radius:12px; box-shadow:0 10px 50px rgba(0,0,0,0.08); text-align:center;">

                <!-- Success Icon -->
                <div style="width:90px; height:90px; background:#f0faf0; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 25px;">
                    <i class="fa fa-check-circle fa-3x" style="color:#27ae60;"></i>
                </div>

                <h2 style="color:#1a1a2e; margin-bottom:10px;">Booking Confirmed!</h2>
                <p style="color:#666; font-size:16px; margin-bottom:30px;">
                    Thank you, <strong style="color:#c9a96e;">{{ $booking->guest->name }}</strong>!
                    Your reservation has been received and is pending confirmation.
                </p>

                <!-- Booking Reference -->
                <div style="background:#1a1a2e; color:#fff; padding:20px; border-radius:8px; margin-bottom:30px;">
                    <div style="font-size:12px; text-transform:uppercase; letter-spacing:2px; color:#c9a96e; margin-bottom:5px;">Booking Reference</div>
                    <div style="font-size:28px; font-weight:700; letter-spacing:3px;">{{ $booking->booking_number }}</div>
                </div>

                <!-- Details Grid -->
                <div class="row text-left mb-4">
                    <div class="col-6">
                        <div style="background:#f8f5f0; padding:15px; border-radius:6px; margin-bottom:15px;">
                            <div style="font-size:11px; text-transform:uppercase; color:#999; letter-spacing:1px; margin-bottom:5px;">Room</div>
                            <strong style="color:#1a1a2e;">{{ $booking->room->roomType->name }}</strong><br>
                            <small style="color:#666;">Room {{ $booking->room->room_number }}</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:#f8f5f0; padding:15px; border-radius:6px; margin-bottom:15px;">
                            <div style="font-size:11px; text-transform:uppercase; color:#999; letter-spacing:1px; margin-bottom:5px;">Guests</div>
                            <strong style="color:#1a1a2e;">{{ $booking->adults }} Adults</strong><br>
                            @if($booking->children > 0)
                                <small style="color:#666;">{{ $booking->children }} Children</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:#f8f5f0; padding:15px; border-radius:6px;">
                            <div style="font-size:11px; text-transform:uppercase; color:#999; letter-spacing:1px; margin-bottom:5px;">Check In</div>
                            <strong style="color:#1a1a2e;">{{ $booking->check_in->format('d M Y') }}</strong><br>
                            <small style="color:#666;">From 2:00 PM</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:#f8f5f0; padding:15px; border-radius:6px;">
                            <div style="font-size:11px; text-transform:uppercase; color:#999; letter-spacing:1px; margin-bottom:5px;">Check Out</div>
                            <strong style="color:#1a1a2e;">{{ $booking->check_out->format('d M Y') }}</strong><br>
                            <small style="color:#666;">Until 11:00 AM</small>
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div style="border:1px solid #e0d9cf; border-radius:8px; padding:20px; margin-bottom:30px; text-align:left;">
                    <div class="d-flex justify-content-between" style="font-size:14px; color:#555; margin-bottom:8px;">
                        <span>Room Charges ({{ $booking->nights }} night{{ $booking->nights > 1 ? 's' : '' }} × ₹{{ number_format($booking->room_rate, 0) }})</span>
                        <strong>₹{{ number_format($booking->room_total, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:14px; color:#555; margin-bottom:8px;">
                        <span>GST (12%)</span>
                        <strong>₹{{ number_format($booking->tax, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:18px; color:#1a1a2e; border-top:1px solid #e0d9cf; margin-top:10px; padding-top:10px;">
                        <strong>Total Amount Due</strong>
                        <strong style="color:#c9a96e;">₹{{ number_format($booking->grand_total, 2) }}</strong>
                    </div>
                    <p style="font-size:12px; color:#999; margin-top:8px; margin-bottom:0;">
                        <i class="fa fa-info-circle mr-1"></i>Payment to be made at hotel during check-in.
                    </p>
                </div>

                @if($booking->special_requests)
                <div style="background:#fffbf0; border:1px solid #f0e6c0; border-radius:6px; padding:15px; margin-bottom:25px; text-align:left;">
                    <strong style="color:#c9a96e;"><i class="fa fa-comment-alt mr-2"></i>Special Requests:</strong>
                    <p style="color:#666; margin:5px 0 0; font-size:14px;">{{ $booking->special_requests }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('front.home') }}" class="theme-btn btn-style-one" style="border:none; padding:12px 30px;">
                        <span class="btn-wrap">
                            <span class="text-one">Back to Home</span>
                            <span class="text-two">Back to Home</span>
                        </span>
                    </a>
                    <a href="{{ route('front.rooms') }}"
                       style="display:inline-block; padding:12px 30px; border:2px solid #1a1a2e; color:#1a1a2e; text-decoration:none; font-weight:600; font-size:14px; letter-spacing:1px; transition:all 0.3s;"
                       onmouseover="this.style.background='#1a1a2e';this.style.color='#fff'"
                       onmouseout="this.style.background='transparent';this.style.color='#1a1a2e'">
                       Explore Rooms
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
</section>

@endsection
