@extends('front.layouts.hotel')
@section('title', $blog->title . ' - Grand Hotel Blog')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Blog Post</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li><a href="{{ route('front.blogs') }}">Blog</a></li>
            <li>{{ \Illuminate\Support\Str::limit($blog->title, 40) }}</li>
        </ul>
    </div>
</section>

<!-- Blog Detail -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="row">

            <!-- Blog Content -->
            <div class="col-lg-8">
                <div style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 5px 30px rgba(0,0,0,0.06);">
                    <!-- Featured Image -->
                    @if($blog->image)
                    <img src="{{ asset('uploads/blogs/original/' . $blog->image) }}" alt="{{ $blog->title }}"
                         style="width:100%; height:400px; object-fit:cover;">
                    @else
                    <img src="{{ asset('hotel-assets/images/resource/news-1.jpg') }}" alt="{{ $blog->title }}"
                         style="width:100%; height:400px; object-fit:cover;">
                    @endif

                    <div style="padding:40px;">
                        <!-- Meta -->
                        <div style="display:flex; align-items:center; gap:20px; margin-bottom:20px; flex-wrap:wrap;">
                            <span style="color:#c9a96e; font-size:13px;">
                                <i class="fa fa-calendar-alt mr-1"></i>
                                {{ $blog->created_at->format('d M Y') }}
                            </span>
                            <span style="color:#999; font-size:13px;">
                                <i class="fa fa-user mr-1"></i> Admin
                            </span>
                            @if($blog->category)
                            <span style="background:#f8f0e0; color:#c9a96e; padding:3px 12px; border-radius:20px; font-size:12px;">
                                {{ $blog->category->name }}
                            </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h2 style="color:#1a1a2e; font-size:28px; margin-bottom:20px; line-height:1.3;">{{ $blog->title }}</h2>

                        <!-- Content -->
                        <div style="color:#555; line-height:1.9; font-size:15px;">
                            {!! $blog->description !!}
                        </div>

                        <!-- Quote -->
                        @if(!empty($blog->quote))
                        <blockquote style="border-left:4px solid #c9a96e; background:#f8f5f0; padding:20px 25px; margin:30px 0; border-radius:0 6px 6px 0;">
                            <p style="color:#1a1a2e; font-size:16px; font-style:italic; margin:0;">"{{ $blog->quote }}"</p>
                        </blockquote>
                        @endif

                        <!-- Tags & Share -->
                        @if(!empty($blog->tags))
                        <div style="border-top:1px solid #f0ebe2; margin-top:30px; padding-top:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px;">
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <strong style="color:#1a1a2e; font-size:14px;">Tags:</strong>
                                @foreach(explode(',', $blog->tags) as $tag)
                                <span style="background:#f8f0e0; color:#c9a96e; padding:4px 12px; border-radius:20px; font-size:12px;">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                            @isset($socialLink)
                            <div style="display:flex; align-items:center; gap:10px;">
                                <strong style="color:#1a1a2e; font-size:14px;">Share:</strong>
                                @if($socialLink->facebook)
                                <a href="{{ $socialLink->facebook }}" target="_blank"
                                   style="width:35px; height:35px; background:#1a1a2e; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; text-decoration:none; font-size:13px;">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                @endif
                                @if($socialLink->instagram)
                                <a href="{{ $socialLink->instagram }}" target="_blank"
                                   style="width:35px; height:35px; background:#1a1a2e; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; text-decoration:none; font-size:13px;">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                @endif
                            </div>
                            @endisset
                        </div>
                        @endif

                        <!-- Navigation -->
                        <div style="border-top:1px solid #f0ebe2; margin-top:30px; padding-top:20px; display:flex; justify-content:space-between;">
                            <a href="{{ route('front.blogs') }}"
                               style="color:#1a1a2e; text-decoration:none; font-size:13px; font-weight:600;">
                                <i class="fa fa-arrow-left mr-1"></i> Back to Blog
                            </a>
                            <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one" style="border:none; font-size:13px; padding:8px 20px;">
                                <span class="btn-wrap">
                                    <span class="text-one">Book a Stay</span>
                                    <span class="text-two">Book a Stay</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">

                <!-- Recent Posts -->
                <div style="background:#fff; padding:30px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06); margin-bottom:25px;">
                    <h5 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:20px;">Recent Posts</h5>
                    @foreach($recentBlogs as $recent)
                    @if($recent->id != $blog->id)
                    <div class="d-flex align-items-center mb-3" style="border-bottom:1px solid #f0ebe2; padding-bottom:12px;">
                        @php
                            $rThumb = $recent->image ? public_path('uploads/blogs/thumbnail/' . $recent->image) : null;
                            $rSrc = ($rThumb && file_exists($rThumb))
                                ? asset('uploads/blogs/thumbnail/' . $recent->image)
                                : asset('hotel-assets/images/resource/news-1.jpg');
                        @endphp
                        <img src="{{ $rSrc }}" alt="{{ $recent->title }}"
                             style="width:60px; height:55px; object-fit:cover; border-radius:4px; margin-right:12px; flex-shrink:0;">
                        <div>
                            <a href="{{ route('front.show', $recent->slug) }}" style="color:#1a1a2e; text-decoration:none; font-size:13px; font-weight:600; line-height:1.4; display:block;">
                                {{ \Illuminate\Support\Str::limit($recent->title, 50) }}
                            </a>
                            <small style="color:#c9a96e;">{{ $recent->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <!-- Book Now Card -->
                <div style="background:#1a1a2e; padding:30px; border-radius:8px; text-align:center; margin-bottom:25px;">
                    <i class="fa fa-bed fa-2x" style="color:#c9a96e; margin-bottom:15px; display:block;"></i>
                    <h5 style="color:#fff; margin-bottom:10px;">Ready to Experience It?</h5>
                    <p style="color:#aaa; font-size:13px; margin-bottom:20px;">Book your luxury stay at Grand Hotel today.</p>
                    <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one w-100" style="border:none;">
                        <span class="btn-wrap">
                            <span class="text-one">Book Now</span>
                            <span class="text-two">Book Now</span>
                        </span>
                    </a>
                </div>

                <!-- Contact Card -->
                <div style="background:#f8f5f0; padding:25px; border-radius:8px; text-align:center;">
                    <i class="fa fa-phone-volume fa-2x" style="color:#c9a96e; margin-bottom:12px; display:block;"></i>
                    <h6 style="color:#1a1a2e; margin-bottom:8px;">Questions?</h6>
                    <p style="color:#666; font-size:13px; margin-bottom:12px;">Our team is here to help you 24/7.</p>
                    @isset($socialLink)
                        @if($socialLink->phone)
                        <a href="tel:{{ $socialLink->phone }}" style="color:#c9a96e; font-weight:700; text-decoration:none; font-size:16px; display:block;">
                            {{ $socialLink->phone }}
                        </a>
                        @endif
                    @endisset
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
