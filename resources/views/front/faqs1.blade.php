@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">FAQS</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQS</li>
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
            <h1 class="font-1 m-0">FAQS</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQS</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


        <div class="section">
            <div class="r-container">
                <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;">
                    <span class="fw-semibold">Frequently Asked Questions</span>
                    <h3 class="font-1 fw-semibold">We Are Here To Help You</h3>
                </div>
                <div class="row row-cols-lg-1 row-cols-1 animate__animated animate__slideInRight">
                    <div class="col mb-3">
                        <div class="accordion d-flex flex-column gap-4" id="faqAccordion1">
                            @foreach($faqs as $key => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $key === 0 ? '' : 'collapsed' }}" 
                                            type="button" 
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faq{{ $faq->id }}" 
                                            aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" 
                                            aria-controls="faq{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" 
                                     class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}" 
                                     data-bs-parent="#faqAccordion1">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection