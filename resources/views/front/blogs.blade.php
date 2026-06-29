@extends('front.layouts.hotel')
@section('title', 'Blog - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>From Our Blog</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Blog</li>
        </ul>
    </div>
</section>

<!-- Blog Section -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="row">

            <!-- Blog Posts -->
            <div class="col-lg-8">
                @forelse($blogs as $blog)
                <div class="news-block_one mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                    <div class="news-block_one-inner" style="display:flex; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.06);">
                        <div style="width:280px; flex-shrink:0;">
                            @php
                                $thumb = $blog->image ? public_path('uploads/blogs/thumbnail/' . $blog->image) : null;
                                $orig  = $blog->image ? public_path('uploads/blogs/original/'   . $blog->image) : null;
                                $imgSrc = ($thumb && file_exists($thumb))
                                    ? asset('uploads/blogs/thumbnail/' . $blog->image)
                                    : (($orig && file_exists($orig))
                                        ? asset('uploads/blogs/original/' . $blog->image)
                                        : asset('hotel-assets/images/resource/news-1.jpg'));
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $blog->title }}"
                                 style="width:100%; height:100%; object-fit:cover; min-height:200px;">
                        </div>
                        <div class="news-block_one-content" style="padding:25px; flex:1;">
                            <div style="color:#c9a96e; font-size:12px; text-transform:uppercase; letter-spacing:1px; margin-bottom:10px;">
                                <i class="fa fa-calendar-alt mr-1"></i>
                                {{ $blog->created_at->format('d M Y') }}
                                @if($blog->category)
                                    <span class="mx-2">|</span>
                                    <a href="{{ route('front.blogs', ['category_id' => $blog->category->id]) }}"
                                       style="color:#c9a96e; text-decoration:none;">{{ $blog->category->name }}</a>
                                @endif
                            </div>
                            <h4 style="color:#1a1a2e; margin-bottom:12px; font-size:18px;">
                                <a href="{{ route('front.show', $blog->slug) }}" style="color:#1a1a2e; text-decoration:none;">
                                    {{ \Illuminate\Support\Str::limit($blog->title, 70) }}
                                </a>
                            </h4>
                            <p style="color:#666; font-size:14px; margin-bottom:15px; line-height:1.7;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 150) }}
                            </p>
                            <a href="{{ route('front.show', $blog->slug) }}" class="theme-btn btn-style-one" style="font-size:13px; padding:8px 20px; border:none; display:inline-block;">
                                <span class="btn-wrap">
                                    <span class="text-one">Read More</span>
                                    <span class="text-two">Read More</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5" style="background:#fff; border-radius:8px; padding:60px;">
                    <i class="fa fa-newspaper fa-3x" style="color:#c9a96e; margin-bottom:20px; display:block;"></i>
                    <h5 style="color:#1a1a2e;">No blog posts available yet.</h5>
                    <p style="color:#666;">Check back soon for updates, news, and travel tips.</p>
                </div>
                @endforelse

                <!-- Pagination -->
                @if($blogs instanceof \Illuminate\Pagination\AbstractPaginator && $blogs->hasPages())
                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                @if(isset($categories) && $categories->count() > 0)
                <div style="background:#fff; padding:30px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06); margin-bottom:25px;">
                    <h5 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:20px;">Categories</h5>
                    <ul style="list-style:none; padding:0; margin:0;">
                        @foreach($categories as $cat)
                        <li style="padding:8px 0; border-bottom:1px solid #f0ebe2;">
                            <a href="{{ route('front.blogs', ['category_id' => $cat->id]) }}"
                               style="color:#555; text-decoration:none; font-size:14px; display:flex; justify-content:space-between; align-items:center;">
                                <span><i class="fa fa-angle-right" style="color:#c9a96e; margin-right:8px;"></i>{{ $cat->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Recent Posts -->
                @if(isset($recentBlogs) && $recentBlogs->count() > 0)
                <div style="background:#fff; padding:30px; border-radius:8px; box-shadow:0 5px 20px rgba(0,0,0,0.06); margin-bottom:25px;">
                    <h5 style="color:#1a1a2e; border-bottom:2px solid #c9a96e; padding-bottom:10px; margin-bottom:20px;">Recent Posts</h5>
                    @foreach($recentBlogs->take(4) as $recent)
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
                    @endforeach
                </div>
                @endif

                <!-- Book Now Card -->
                <div style="background:#1a1a2e; padding:30px; border-radius:8px; text-align:center;">
                    <i class="fa fa-bed fa-2x" style="color:#c9a96e; margin-bottom:15px; display:block;"></i>
                    <h5 style="color:#fff; margin-bottom:10px;">Book Your Stay</h5>
                    <p style="color:#aaa; font-size:13px; margin-bottom:20px;">Experience luxury and comfort at Grand Hotel.</p>
                    <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one w-100" style="border:none;">
                        <span class="btn-wrap">
                            <span class="text-one">Book Now</span>
                            <span class="text-two">Book Now</span>
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
