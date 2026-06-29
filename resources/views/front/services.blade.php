@extends('front.layouts.hotel')
@section('title', 'Hotel Services - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Our Services</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Services</li>
        </ul>
    </div>
</section>

<!-- Services Section -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title">WHAT WE OFFER</div>
            <h2 class="sec-title_heading">Hotel Services & Amenities</h2>
        </div>

        @if($services->count() > 0)
        <div class="row clearfix">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div class="service-block_one">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-swimming-pool trans-500"></div>
                        <h4 class="service-block_one-title">{{ $service->title }}</h4>
                        <div class="service-block_one-text trans-500">
                            {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 120) }}
                        </div>
                        <a class="service-block_one-arrow trans-500 flaticon-arrow-up" href="#"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default services if none in DB -->
        <div class="row clearfix">
            @php
            $defaultServices = [
                ['icon'=>'flaticon-swimming-pool', 'title'=>'Swimming Pool', 'text'=>'Relax in our temperature-controlled outdoor pool, open daily from 6 AM to 10 PM.'],
                ['icon'=>'flaticon-cutlery', 'title'=>'Restaurant & Bar', 'text'=>'Enjoy fine dining and a curated selection of wines and cocktails at our in-house restaurant.'],
                ['icon'=>'flaticon-sleeping', 'title'=>'Spa & Wellness', 'text'=>'Revitalize your mind and body with our full-range spa treatments and wellness programs.'],
                ['icon'=>'flaticon-wifi', 'title'=>'Free Wi-Fi', 'text'=>'Complimentary high-speed internet access available throughout the hotel premises.'],
                ['icon'=>'flaticon-tea', 'title'=>'Room Service', 'text'=>'24-hour in-room dining service with a wide selection of local and international cuisine.'],
                ['icon'=>'flaticon-swimming-pool', 'title'=>'Conference Facilities', 'text'=>'State-of-the-art meeting rooms and event spaces for business and social gatherings.'],
            ]
            @endphp
            @foreach($defaultServices as $s)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div class="service-block_one">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon {{ $s['icon'] }} trans-500"></div>
                        <h4 class="service-block_one-title">{{ $s['title'] }}</h4>
                        <div class="service-block_one-text trans-500">{{ $s['text'] }}</div>
                        <a class="service-block_one-arrow trans-500 flaticon-arrow-up" href="#"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Extra amenities highlight -->
        <div style="background:#1a1a2e; padding:50px; border-radius:8px; margin-top:50px;">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h3 style="color:#c9a96e; margin-bottom:15px;">Premium Amenities Included</h3>
                    <div class="row">
                        @php
                        $amenities = ['Complimentary Breakfast','Daily Housekeeping','Airport Shuttle','Valet Parking','Kids Play Area','Laundry Service','Business Center','Fitness Center'];
                        @endphp
                        @foreach($amenities as $am)
                        <div class="col-6 mb-2">
                            <span style="color:#c9a96e; margin-right:8px;"><i class="fa fa-check-circle"></i></span>
                            <span style="color:#ccc; font-size:14px;">{{ $am }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <p style="color:#aaa; margin-bottom:20px;">Experience luxury at its finest. Book now and enjoy all premium amenities.</p>
                    <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one" style="border:none;">
                        <span class="btn-wrap">
                            <span class="text-one">Book Your Stay <i class="fa-solid fa-arrow-right"></i></span>
                            <span class="text-two">Book Your Stay <i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
