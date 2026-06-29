@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
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
            <h1 class="font-1 m-0">Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="section">
        <div class="r-container d-flex flex-column gap-4">
            <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;">
                <span class="fw-semibold">SERVICES</span>
                <h3 class="font-1 fw-semibold">Your Mental Health Is Our Priority</h3>
                {{-- <p class="text-gray">
                    Curabitur quis diam malesuada sem porta mollis. Ut vel tortor in neque sollicitudin
                    feugiat a ac ex. Etiam eleifend orci eget tempus rhoncus. Nunc ligula erat, elementum eu
                    augue at, pharetra iaculis leo.
                </p> --}}
            </div>

            <div class="row row-cols-lg-4 row-cols-1 mb-4 animate__animated animate__slideInRight">
                @forelse($services as $service)
                    {{-- <div class="col mb-4">
                        <div class="card p-5 d-flex flex-column justify-content-center shadow gap-3" style="height: 100%;">
                            <div class="icon-box accent-color-2">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                            <h5 class="font-1 m-0">{{ $service->title }}</h5>
                            <p class="text-gray">
                                {{ Str::limit(strip_tags($service->description), 100) }}
                            </p>
                  
                        </div>
                    </div> --}}

                    <div class="col mb-4">
    <div class="card h-100 p-4 d-flex flex-column text-center shadow">
        <div class="text-center mb-4">
            <i class="{{ $service->icon }}" style="font-size: 4rem; color: #81d742;"></i>
        </div>

        <h5 class="font-1 fw-semibold mb-0" style="min-height: 48px; line-height: 24px;">
            {{ $service->title }}
        </h5>

        <p class="text-gray mt-4 mb-0">
            {{ Str::limit(strip_tags($service->description), 300) }}
        </p>
    </div>
</div>

                    
                @empty
                    <div class="col-12 text-center">
                        <p>No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
