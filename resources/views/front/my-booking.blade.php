@extends('front.layouts.hotel')
@section('title', 'My Booking - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>My Booking</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>My Booking</li>
        </ul>
    </div>
</section>

<!-- Lookup Section -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <!-- Icon Header -->
                <div class="text-center mb-4">
                    <div style="width:80px; height:80px; background:#c9a96e; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                        <i class="fa fa-search fa-2x" style="color:#fff;"></i>
                    </div>
                    <h3 style="color:#1a1a2e; margin-bottom:8px;">Find Your Booking</h3>
                    <p style="color:#777;">Enter your Booking Number and registered Phone Number to view your booking details.</p>
                </div>

                <!-- Error Alert -->
                @if($errors->has('not_found'))
                <div style="background:#fff3f3; border:1px solid #f5c6cb; color:#721c24; padding:15px 20px; border-radius:6px; margin-bottom:20px; display:flex; align-items:flex-start; gap:12px;">
                    <i class="fa fa-exclamation-circle" style="color:#e74c3c; margin-top:2px; flex-shrink:0;"></i>
                    <span>{{ $errors->first('not_found') }}</span>
                </div>
                @endif

                <!-- Lookup Form -->
                <div style="background:#fff; padding:40px; border-radius:10px; box-shadow:0 10px 40px rgba(0,0,0,0.08);">
                    <form action="{{ route('front.findBooking') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label style="display:block; font-weight:600; color:#1a1a2e; margin-bottom:8px; font-size:14px;">
                                <i class="fa fa-hashtag" style="color:#c9a96e; margin-right:6px;"></i>
                                Booking Number *
                            </label>
                            <input type="text" name="booking_number"
                                   value="{{ old('booking_number') }}"
                                   class="form-control"
                                   style="border:2px solid #e8e0d5; padding:12px 16px; font-size:15px; border-radius:6px; text-transform:uppercase; letter-spacing:1px;"
                                   placeholder="e.g. BK20260413000001"
                                   required autofocus>
                            <small style="color:#999; font-size:12px; margin-top:5px; display:block;">
                                You received this in your booking confirmation.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label style="display:block; font-weight:600; color:#1a1a2e; margin-bottom:8px; font-size:14px;">
                                <i class="fa fa-phone" style="color:#c9a96e; margin-right:6px;"></i>
                                Registered Phone Number *
                            </label>
                            <input type="text" name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control"
                                   style="border:2px solid #e8e0d5; padding:12px 16px; font-size:15px; border-radius:6px;"
                                   placeholder="Phone number used during booking"
                                   required>
                        </div>

                        <button type="submit" class="theme-btn btn-style-one w-100" style="border:none; padding:14px;">
                            <span class="btn-wrap">
                                <span class="text-one">Find My Booking <i class="fa-solid fa-arrow-right ml-2"></i></span>
                                <span class="text-two">Find My Booking <i class="fa-solid fa-arrow-right ml-2"></i></span>
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Help Note -->
                <div style="text-align:center; margin-top:25px;">
                    <p style="color:#888; font-size:13px; margin-bottom:8px;">
                        <i class="fa fa-info-circle" style="color:#c9a96e; margin-right:5px;"></i>
                        Can't find your booking? Contact our front desk.
                    </p>
                    @isset($socialLink)
                        @if($socialLink->phone)
                        <a href="tel:{{ $socialLink->phone }}" style="color:#c9a96e; font-weight:700; text-decoration:none; font-size:16px;">
                            <i class="fa fa-phone mr-1"></i> {{ $socialLink->phone }}
                        </a>
                        @endif
                    @endisset
                </div>

            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section style="padding:60px 0; background:#1a1a2e;">
    <div class="auto-container">
        <h4 class="text-center" style="color:#c9a96e; margin-bottom:35px;">What You Can Do Here</h4>
        <div class="row text-center">
            @php
            $features = [
                ['icon'=>'fa-calendar-check','title'=>'View Booking Status','desc'=>'Check if your booking is confirmed, checked-in, or completed.'],
                ['icon'=>'fa-file-invoice','title'=>'Download Invoice','desc'=>'Print or save your booking invoice with full charge breakdown.'],
                ['icon'=>'fa-bed','title'=>'Room Details','desc'=>'See your room type, floor, check-in & check-out dates.'],
                ['icon'=>'fa-utensils','title'=>'Added Services','desc'=>'View all extra services added to your booking.'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="col-lg-3 col-md-6 mb-4">
                <div style="padding:20px;">
                    <div style="width:55px; height:55px; background:rgba(201,169,110,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px;">
                        <i class="fa {{ $f['icon'] }}" style="color:#c9a96e; font-size:20px;"></i>
                    </div>
                    <h6 style="color:#fff; margin-bottom:8px;">{{ $f['title'] }}</h6>
                    <p style="color:#aaa; font-size:13px; margin:0;">{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
// Auto uppercase booking number
document.querySelector('input[name="booking_number"]').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});
</script>
@endsection
