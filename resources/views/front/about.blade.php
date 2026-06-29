@extends('front.layouts.hotel')
@section('title', 'About Us - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>About Us</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>About Us</li>
        </ul>
    </div>
</section>

<!-- About Section -->
<section class="about-one" style="padding:80px 0;">
    <div class="auto-container">
        <div class="row align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0ms">
                <div class="about-one_image">
                    <img src="{{ $about && $about->image ? asset($about->image) : asset('hotel-assets/images/resource/about-1.jpg') }}"
                         alt="About Grand Hotel" style="width:100%; border-radius:8px;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0ms">
                <div class="about-one_content" style="padding-left:30px;">
                    <div class="sec-title title-anim">
                        <div class="sec-title_title">ABOUT US</div>
                        <h2 class="sec-title_heading">{{ $about->title ?? 'Welcome to Grand Hotel' }}</h2>
                    </div>
                    <div class="about-one_text" style="color:#555; line-height:1.9; margin-bottom:25px;">
                        {!! $about->description ?? 'Experience the finest hospitality with world-class amenities and exceptional service. Our hotel is dedicated to making your stay an unforgettable journey of luxury and comfort.' !!}
                    </div>

                    <!-- Stats -->
                    <div class="row text-center" style="background:#f8f5f0; padding:20px; border-radius:8px; margin-bottom:25px;">
                        <div class="col-4">
                            <div style="font-size:32px; font-weight:700; color:#c9a96e;">15+</div>
                            <div style="font-size:13px; color:#666;">Years Experience</div>
                        </div>
                        <div class="col-4">
                            <div style="font-size:32px; font-weight:700; color:#c9a96e;">5K+</div>
                            <div style="font-size:13px; color:#666;">Happy Guests</div>
                        </div>
                        <div class="col-4">
                            <div style="font-size:32px; font-weight:700; color:#c9a96e;">50+</div>
                            <div style="font-size:13px; color:#666;">Luxury Rooms</div>
                        </div>
                    </div>

                    <a href="{{ route('front.rooms') }}" class="theme-btn btn-style-one">
                        <span class="btn-wrap">
                            <span class="text-one">Explore Rooms <i class="fa-solid fa-arrow-right"></i></span>
                            <span class="text-two">Explore Rooms <i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title">WHY CHOOSE US</div>
            <h2 class="sec-title_heading">The Grand Hotel Difference</h2>
        </div>
        <div class="row clearfix">
            @php
            $reasons = [
                ['icon'=>'fa-concierge-bell','title'=>'World-Class Service','text'=>'Our trained staff provides 24/7 personalized service to exceed your expectations.'],
                ['icon'=>'fa-bed','title'=>'Luxury Rooms','text'=>'Every room is designed with premium furnishings and modern amenities for maximum comfort.'],
                ['icon'=>'fa-utensils','title'=>'Fine Dining','text'=>'Savor exquisite cuisines prepared by award-winning chefs at our in-house restaurants.'],
                ['icon'=>'fa-spa','title'=>'Spa & Wellness','text'=>'Rejuvenate your body and mind at our world-class spa and wellness center.'],
                ['icon'=>'fa-wifi','title'=>'High-Speed Wi-Fi','text'=>'Stay connected with complimentary high-speed internet throughout the property.'],
                ['icon'=>'fa-shield-alt','title'=>'Safe & Secure','text'=>'Advanced security systems ensure a safe and worry-free stay for all guests.'],
            ]
            @endphp
            @foreach($reasons as $reason)
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div style="background:#fff; padding:30px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.05); height:100%;">
                    <div style="width:60px; height:60px; background:#f8f0e0; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                        <i class="fa {{ $reason['icon'] }} fa-lg" style="color:#c9a96e;"></i>
                    </div>
                    <h5 style="color:#1a1a2e; margin-bottom:10px;">{{ $reason['title'] }}</h5>
                    <p style="color:#666; font-size:14px; margin:0;">{{ $reason['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section style="padding:80px 0; background:#1a1a2e;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title" style="color:#c9a96e;">TESTIMONIALS</div>
            <h2 class="sec-title_heading text-white">What Our Guests Say</h2>
        </div>
        <div class="row">
            @foreach($testimonials->take(3) as $t)
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms">
                <div style="background:rgba(255,255,255,0.05); padding:30px; border-radius:8px; border:1px solid rgba(201,169,110,0.3); height:100%;">
                    <div style="color:#ccc; font-size:14px; line-height:1.8; margin-bottom:20px;">
                        "{{ $t->description }}"
                    </div>
                    <div class="d-flex align-items-center">
                        @if($t->image)
                            <img src="{{ asset($t->image) }}" style="width:45px; height:45px; border-radius:50%; object-fit:cover; margin-right:12px;">
                        @else
                            <div style="width:45px; height:45px; border-radius:50%; background:#c9a96e; display:flex; align-items:center; justify-content:center; margin-right:12px;">
                                <i class="fa fa-user" style="color:#fff;"></i>
                            </div>
                        @endif
                        <div>
                            <h6 style="color:#c9a96e; margin:0;">{{ $t->name }}</h6>
                            <small style="color:#aaa;">{{ $t->designation ?? 'Guest' }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section style="padding:80px 0; background:#c9a96e;">
    <div class="auto-container text-center">
        <h2 style="color:#fff; margin-bottom:15px;">Ready for an Unforgettable Stay?</h2>
        <p style="color:rgba(255,255,255,0.85); font-size:16px; margin-bottom:30px;">Book your room today and experience the Grand Hotel difference.</p>
        <a href="{{ route('front.booking') }}" class="theme-btn btn-style-two">
            <span class="btn-wrap">
                <span class="text-one">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                <span class="text-two">Book Now <i class="fa-solid fa-arrow-right"></i></span>
            </span>
        </a>
    </div>
</section>

@endsection
