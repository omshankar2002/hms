@extends('front.layouts.hotel')
@section('title', 'Grand Hotel - Luxury Hospitality')

@section('content')

<!-- Hero Slider -->
<section class="slider-one">
    <div class="slider-one_pattern" style="background-image:url({{ asset('hotel-assets/images/main-slider/pattern-1.jpg') }})"></div>
    <div class="slider-one_dotted" style="background-image:url({{ asset('hotel-assets/images/main-slider/dotted.png') }})"></div>
    <div class="main-slider swiper-container">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="slider-one_big-title"><span class="up-down_animation">Grand Hotel</span></div>
                <div class="slider-one_image-layer" style="background-image:url({{ asset('hotel-assets/images/main-slider/image-1.jpg') }})"></div>
                <div class="auto-container">
                    <div class="slider-one_content">
                        <div class="slider-one_content-inner">
                            <div class="slider-one_title trans-900">Luxury & Comfort</div>
                            <h1 class="slider-one_heading trans-900">Perfect Place For Your Dream Vacation</h1>
                            <div class="slider-one_text trans-900">Experience world-class hospitality with breathtaking views and exceptional amenities.</div>
                            <div class="slider-one_button trans-900 d-flex align-items-center flex-wrap">
                                <a href="{{ route('front.booking') }}" class="theme-btn btn-style-two">
                                    <span class="btn-wrap">
                                        <span class="text-one">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                                        <span class="text-two">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="slider-one_big-title"><span class="up-down_animation">Grand Hotel</span></div>
                <div class="slider-one_image-layer" style="background-image:url({{ asset('hotel-assets/images/main-slider/image-1.jpg') }})"></div>
                <div class="auto-container">
                    <div class="slider-one_content">
                        <div class="slider-one_content-inner">
                            <div class="slider-one_title trans-900">Discover Luxury</div>
                            <h1 class="slider-one_heading trans-900">Where Every Stay Becomes A Memory</h1>
                            <div class="slider-one_text trans-900">Indulge in the finest amenities and impeccable service crafted for your comfort.</div>
                            <div class="slider-one_button trans-900 d-flex align-items-center flex-wrap">
                                <a href="{{ route('front.rooms') }}" class="theme-btn btn-style-two">
                                    <span class="btn-wrap">
                                        <span class="text-one">Explore Rooms <i class="fa-solid fa-arrow-right"></i></span>
                                        <span class="text-two">Explore Rooms <i class="fa-solid fa-arrow-right"></i></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="slider-one-arrow">
            <div class="main-slider-prev trans-300 fas fa-arrow-left fa-fw"></div>
            <div class="main-slider-next trans-300 fas fa-arrow-right fa-fw"></div>
        </div>
    </div>
</section>

<!-- Quick Booking Bar -->
<section style="background:#1a1a2e; padding:30px 0;">
    <div class="auto-container">
        <form action="{{ route('front.booking') }}" method="GET" class="row align-items-end g-3">
            <div class="col-lg-3 col-md-6">
                <label style="color:#c9a96e; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Check In</label>
                <input type="date" name="check_in" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" style="border-radius:0; background:#fff;">
            </div>
            <div class="col-lg-3 col-md-6">
                <label style="color:#c9a96e; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Check Out</label>
                <input type="date" name="check_out" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}" style="border-radius:0; background:#fff;">
            </div>
            <div class="col-lg-2 col-md-6">
                <label style="color:#c9a96e; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Adults</label>
                <select name="adults" class="form-control" style="border-radius:0;">
                    <option>1</option><option selected>2</option><option>3</option><option>4</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6">
                <label style="color:#c9a96e; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Room Type</label>
                <select name="room_type_id" class="form-control" style="border-radius:0;">
                    <option value="">Any Type</option>
                    @foreach($roomTypes as $rt)
                        <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="theme-btn btn-style-one w-100" style="border:none; padding:10px 20px;">
                    <span class="btn-wrap">
                        <span class="text-one">Check Availability</span>
                        <span class="text-two">Check Availability</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- About Section -->
@if($about)
<section class="about-one">
    <div class="auto-container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-one_image wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <img src="{{ $about->image ? asset($about->image) : asset('hotel-assets/images/resource/about-1.jpg') }}" alt="About Grand Hotel">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-one_content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="sec-title title-anim">
                        <div class="sec-title_title">ABOUT US</div>
                        <h2 class="sec-title_heading">{{ $about->title ?? 'Welcome to Grand Hotel' }}</h2>
                    </div>
                    <div class="about-one_text">{!! $about->description ?? 'Experience the finest hospitality with world-class amenities and exceptional service.' !!}</div>
                    <a href="{{ route('front.about') }}" class="theme-btn btn-style-one mt-4">
                        <span class="btn-wrap">
                            <span class="text-one">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                            <span class="text-two">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Featured Rooms -->
@if($roomTypes->count() > 0)
<section class="features-one" style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title">OUR ROOMS</div>
            <h2 class="sec-title_heading">Featured Rooms & Suites</h2>
        </div>

        <div class="features-carousel swiper-container">
            <div class="swiper-wrapper">
                @foreach($roomTypes as $rt)
                <div class="swiper-slide">
                    <div class="feature-block_one">
                        <div class="feature-block_one-inner">
                            <div class="feature-block_one-image">
                                <img class="trans-500"
                                    src="{{ $rt->image ? asset($rt->image) : asset('hotel-assets/images/gallery/'.($loop->iteration).'.jpg') }}"
                                    alt="{{ $rt->name }}" style="width:100%; height:280px; object-fit:cover;">
                                <div class="feature-block_one-content trans-500">
                                    <ul class="feature-block_one-icon">
                                        <li class="flaticon-wifi"></li>
                                        <li class="flaticon-cutlery"></li>
                                        <li class="flaticon-tea"></li>
                                        <li class="flaticon-sleeping"></li>
                                    </ul>
                                    <h3 class="feature-block_one-title">
                                        <a href="{{ route('front.room-detail', $rt->slug) }}">{{ $rt->name }}</a>
                                    </h3>
                                    <div class="feature-block_one-price">
                                        ₹{{ number_format($rt->base_price, 0) }} <span>Per Night</span>
                                    </div>
                                    <a class="feature-block_one-arrow trans-500 flaticon-arrow-up"
                                       href="{{ route('front.room-detail', $rt->slug) }}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('front.rooms') }}" class="theme-btn btn-style-one">
                <span class="btn-wrap">
                    <span class="text-one">View All Rooms <i class="fa-solid fa-arrow-right"></i></span>
                    <span class="text-two">View All Rooms <i class="fa-solid fa-arrow-right"></i></span>
                </span>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Services Section -->
@if($services->count() > 0)
<section class="service-one" style="padding:80px 0;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title">WHAT WE OFFER</div>
            <h2 class="sec-title_heading">Our Hotel Services</h2>
        </div>
        <div class="row clearfix">
            @foreach($services->take(6) as $service)
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div class="service-block_one">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-swimming-pool trans-500"></div>
                        <h4 class="service-block_one-title">
                            <a class="trans-500" href="{{ route('front.services') }}">{{ $service->title }}</a>
                        </h4>
                        <div class="service-block_one-text trans-500">
                            {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 100) }}
                        </div>
                        <a class="service-block_one-arrow trans-500 flaticon-arrow-up" href="{{ route('front.services') }}"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
                <div class="testimonial-block_one" style="background:rgba(255,255,255,0.05); padding:30px; border-radius:8px; border:1px solid rgba(201,169,110,0.3); height:100%;">
                    <div class="testimonial-block_one-text" style="color:#ccc; margin-bottom:20px;">
                        "{{ $t->description }}"
                    </div>
                    <div class="d-flex align-items-center">
                        @if($t->image)
                            <img src="{{ asset($t->image) }}" style="width:50px; height:50px; border-radius:50%; object-fit:cover; margin-right:15px;">
                        @else
                            <div style="width:50px; height:50px; border-radius:50%; background:#c9a96e; display:flex; align-items:center; justify-content:center; margin-right:15px;">
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

<!-- Latest Blogs -->
@if($blogs->count() > 0)
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title">LATEST NEWS</div>
            <h2 class="sec-title_heading">From Our Blog</h2>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms">
                <div class="news-block_one">
                    <div class="news-block_one-inner">
                        <div class="news-block_one-image">
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width:100%; height:220px; object-fit:cover;">
                            @else
                                <img src="{{ asset('hotel-assets/images/resource/news-1.jpg') }}" alt="{{ $blog->title }}" style="width:100%; height:220px; object-fit:cover;">
                            @endif
                        </div>
                        <div class="news-block_one-content" style="padding:20px; background:#fff;">
                            <div style="color:#c9a96e; font-size:12px; margin-bottom:8px;">
                                {{ $blog->created_at->format('d M Y') }}
                            </div>
                            <h4><a href="{{ route('front.show', $blog->slug) }}" style="color:#1a1a2e;">
                                {{ \Illuminate\Support\Str::limit($blog->title, 60) }}
                            </a></h4>
                            <a href="{{ route('front.show', $blog->slug) }}" class="theme-btn btn-style-one" style="margin-top:15px; font-size:13px; padding:8px 20px;">
                                <span class="btn-wrap">
                                    <span class="text-one">Read More</span>
                                    <span class="text-two">Read More</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
