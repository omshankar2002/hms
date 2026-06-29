@extends('front.layouts.hotel')
@section('title', 'Guest Reviews - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Guest Reviews</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Testimonials</li>
        </ul>
    </div>
</section>

<!-- Testimonials -->
<section style="padding:80px 0; background:#1a1a2e;">
    <div class="auto-container">
        <div class="sec-title title-anim text-center">
            <div class="sec-title_title" style="color:#c9a96e;">WHAT GUESTS SAY</div>
            <h2 class="sec-title_heading text-white">Real Experiences, Real Reviews</h2>
        </div>

        @if($testimonials->count() > 0)
        <div class="row">
            @foreach($testimonials as $t)
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div style="background:rgba(255,255,255,0.05); padding:30px; border-radius:8px; border:1px solid rgba(201,169,110,0.25); height:100%; display:flex; flex-direction:column;">
                    <!-- Stars -->
                    <div style="margin-bottom:15px;">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fa fa-star" style="color:#c9a96e; font-size:13px;"></i>
                        @endfor
                    </div>
                    <!-- Text -->
                    <p style="color:#ccc; font-size:14px; line-height:1.8; flex:1; margin-bottom:20px;">
                        "{{ $t->description ?? $t->comments ?? '' }}"
                    </p>
                    <!-- Author -->
                    <div class="d-flex align-items-center" style="border-top:1px solid rgba(255,255,255,0.1); padding-top:15px;">
                        @if($t->image)
                            <img src="{{ asset($t->image) }}" style="width:45px; height:45px; border-radius:50%; object-fit:cover; margin-right:12px; border:2px solid #c9a96e;">
                        @else
                            <div style="width:45px; height:45px; border-radius:50%; background:#c9a96e; display:flex; align-items:center; justify-content:center; margin-right:12px; flex-shrink:0;">
                                <i class="fa fa-user" style="color:#fff;"></i>
                            </div>
                        @endif
                        <div>
                            <div style="color:#c9a96e; font-weight:600; font-size:15px;">{{ $t->name }}</div>
                            <div style="color:#aaa; font-size:12px;">{{ $t->designation ?? 'Hotel Guest' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fa fa-comment-slash fa-3x" style="color:#c9a96e; margin-bottom:20px; display:block;"></i>
            <h5 class="text-white">No reviews yet. Be the first to share your experience!</h5>
        </div>
        @endif
    </div>
</section>

<!-- CTA -->
<section style="padding:70px 0; background:#f8f5f0;">
    <div class="auto-container text-center">
        <h3 style="color:#1a1a2e; margin-bottom:15px;">Experience It Yourself</h3>
        <p style="color:#666; margin-bottom:25px;">Join thousands of happy guests. Book your luxury stay today.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one" style="border:none;">
                <span class="btn-wrap">
                    <span class="text-one">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                    <span class="text-two">Book Now <i class="fa-solid fa-arrow-right"></i></span>
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
</section>

@endsection
