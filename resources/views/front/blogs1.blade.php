@extends('front.layouts.app')

@section('content')
    {{-- Desktop Background --}}
    <div class="section position-relative desktop-hero"
        style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
        <div class="image-overlay"></div>
        <div class="r-container h-100 position-relative" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
                style="max-width: 895px;">
                <h1 class="font-1 m-0">Blogs</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                <h1 class="font-1 m-0">Blogs</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="section">
        <div class="r-container d-flex flex-column gap-4">
            <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;">
                <h3 class="font-1 fw-semibold">Latest Blogs</h3>
            </div>

            <div class="row mb-4 animate__animated animate__slideInUp">
                <!-- Left Column: Blog Cards -->
                <div class="col-lg-8">
                    <div class="row row-cols-lg-2 row-cols-1">
                        @foreach ($blogs as $blog)
                            <div class="col mb-3">
                                <div class="border border-accent-color rounded-3 overflow-hidden">
                                    <a href="{{ route('front.show', $blog->slug) }}">
                                        @if ($blog->image)
                                            <img src="{{ asset('uploads/blogs/thumbnail/' . $blog->image) }}"
                                                alt="{{ $blog->title }}">
                                        @else
                                            <img src="{{ asset('assets/image/placeholder.jpg') }}" alt="Default image"
                                                class="img-fluid">
                                        @endif
                                    </a>

                                    <div class="py-4 px-5 d-flex flex-column gap-3">
                                        {{-- <div class="d-flex flex-row gap-2 align-items-center accent-color">
                                            <i class="fa-solid fa-calendar-alt"></i>
                                            {{ $blog->created_at->format('F, d Y') }}
                                        </div> --}}
                                        <div class="mb-3">
                                            <a href="{{ route('front.show', $blog->slug) }}"
                                                class="text-black font-1 fs-4 lh-1 fw-semibold">
                                                {{ Str::limit($blog->title, 60, '...') }}
                                            </a>
                                        </div>
                                        {{-- <div class="blog-excerpt">
                                            {!! Str::limit(strip_tags($blog->content), 120, '...') !!}
                                        </div> --}}
                                        {{-- <p> --}}
                                        <div>
                                            <a href="{{ route('front.show', $blog->slug) }}"
                                                class="link accent-color py-3">
                                                READ MORE <i class="fa-solid fa-arrow-right px-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Remove pagination if not needed -->
                    @if ($blogs instanceof \Illuminate\Pagination\AbstractPaginator && $blogs->hasPages())
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $blogs->links() }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Recent News + CTA + Image -->
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-4">
                        <!-- Recent News -->
                        <div class="border border-accent-color rounded-3 py-5 px-4 d-flex flex-column gap-3">
                            <h5 class="font-1" style="margin-top: -35px;">Recent Blogs</h5>
                            <div class="d-flex flex-column gap-4" style="margin-bottom: -11px">
                                @foreach ($recentBlogs as $blog)
                                    <div class="row row-cols-2">
                                        <div class="col-5">
                                            @php
                                                $imagePath = null;

                                                if ($blog->image) {
                                                    $thumbPath = public_path('uploads/blogs/thumbnail/' . $blog->image);
                                                    $imagePath = file_exists($thumbPath)
                                                        ? asset('uploads/blogs/thumbnail/' . $blog->image)
                                                        : asset('uploads/blogs/original/' . $blog->image);
                                                } else {
                                                    $imagePath = asset('front-assets/images/placeholder.jpg');
                                                }
                                            @endphp

                                            <img src="{{ $imagePath }}" alt="entry image" class="rounded-3 img-fluid">

                                        </div>
                                        <div class="col-7">
                                            <div class="d-flex flex-column gap-2 h-100 justify-content-center">
                                                {{-- <div class="d-flex flex-row gap-3 accent-color align-items-center">
                                                    <i class="fa-solid fa-calendar-alt"></i>
                                                    <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                                </div> --}}
                                                <a href="{{ route('front.show', $blog->slug) }}" class="link">
                                                    <h6 class="font-1 fs-5">{{ Str::limit($blog->title, 60, '...') }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CTA Banner -->
                        <div class="position-relative overflow-hidden rounded-3"
                            style="background-image: url('{{ asset('image/image-600x400-8.jpg') }}'); background-size: cover; background-position: center;">
                            <div class="image-overlay"></div>
                            <div class="position-relative p-5" style="z-index: 2;">
                                <div class="d-flex flex-column mx-auto text-center align-items-center text-white gap-4">
                                    <h4 class="font-1 fw-semibold">Mental Health Support Anytime, Anywhere!</h4>
                                    <div>
                                        <a href="{{ route('front.appointment') }}"
                                            class="btn btn-white-accent px-4 py-3 fw-semibold">BOOK
                                            APPOINTMENT</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <form method="GET" action="{{ route('front.blogs') }}">
                            <div class="form-group" style="position: relative; display: inline-block; width: 100%;">
                                <h5 class="font-1">Blog Categories</h5>
                                <select name="category_id" onchange="this.form.submit()"
                                    style="
                                    width: 100%;
                                    border: 1px solid #580069;
                                    appearance: none; /* Remove default arrow */
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    padding: 8px 30px 8px 10px; /* Add right padding for arrow */
                                    background: white url('data:image/svg+xml;utf8,<svg fill=\'%23580069\' height=\'10\' viewBox=\'0 0 24 24\' width=\'10\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>') no-repeat right 10px center;
                                    background-size: 20px 20px;
                                    cursor: pointer;
                                    border-radius : 5px;

                                ">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>


                        <!-- Badge/Image -->
                        <div class="center" style=" display: flex; justify-content: center;">
                            <img class="aligncenter size-thumbnail wp-image-545"
                                src="{{ asset('front-assets/image/honored-listee.png') }}" alt="Honored Listee"
                                width="200" height="200">
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
