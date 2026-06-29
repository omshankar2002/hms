@extends('front.layouts.app')

@section('content')
{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Testimonials</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

{{-- Mobile Background --}}
<div class="section position-relative mobile-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb1.jpg') }}); height: 50vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Testimonials</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="section">
        <div class="r-container">
            <div class="row row-cols-lg-2 row-cols-1 mb-5">
                <div class="col mb-3">
                    <div class="d-flex flex-column gap-3">
                        <span class="fw-semibold">TESTIMONIALS</span>
                        <h3 class="font-1 fw-semibold">What They Say About Us</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <!-- Slides -->
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="d-flex flex-column gap-3 p-4 shadow rounded-3">
                                    <ul class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <li><i class="fa-solid fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <p class="fst-italic">
                                        {{ $testimonial->comments }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row gap-3">
                                            {{-- <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}"
                                                alt="{{ $testimonial->name }}" class="img-fluid rounded-circle"
                                                width="70" height="70"> --}}
                                            <div class="d-flex flex-column h-100 justify-content-center">
                                                <span class="text-black">{{ $testimonial->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
           <div class="d-flex justify-content-center mt-4">
            <a href="https://www.google.com/search?q=Now+Voyager+Counseling+Hypnosis&sca_esv=d743d26c8a087e94&sca_upv=1&rlz=1C1JJTC_enIN1094IN1095&sxsrf=ADLYWIIuAd0Ff6zd45N9HT4Myll03_gR-A%3A1726164686891&ei=zi7jZq2UNq6O4-EPvcSS8Ac&ved=0ahUKEwits_HHgL6IAxUuxzgGHT2iBH4Q4dUDCA8&uact=5&oq=Now+Voyager+Counseling+Hypnosis&gs_lp=Egxnd3Mtd2l6LXNlcnAiH05vdyBWb3lhZ2VyIENvdW5zZWxpbmcgSHlwbm9zaXMyBRAhGKABSLMkUABYsyFwAXgAkAEAmAH2AaAB6QOqAQMyLTK4AQPIAQD4AQL4AQGYAgOgAvgDmAMA4gMFEgExIECSBwUxLjAuMqAHxAQ&sclient=gws-wiz-serp#lrd=0x872b128b70493055:0xbc641a71fc204750,1,,,," target="_blank" class="btn btn-accent-outline px-5 py-3 rounded-3 fw-semibold">
                More Testimonials
            </a>
        </div>
    </div>
@endsection
