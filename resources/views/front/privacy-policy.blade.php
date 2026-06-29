@extends('front.layouts.app')

@section('content')
    <div class="section position-relative"
        style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top;">
        <div class="image-overlay"></div>
        <div class="r-container h-100 position-relative" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
                style="max-width: 895px;">
                <h1 class="font-1 m-0">Privacy Policies</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Privacy Policies</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


@endsection
