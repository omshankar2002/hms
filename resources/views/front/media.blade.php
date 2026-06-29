@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Media</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Media</li>
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
            <h1 class="font-1 m-0">Media</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Media</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
  
        <div class="mt-5 mb-5">
            <div id="pageheader" class="titleclass">
                <div class="container">
                    <div class="page-header">
                        <h3 class="font-1 fw-semibold">Media</h3>
                    </div>
                </div>
            </div>
        
            <div id="content" class="container container-contained">
                <div class="row">
                    <div class="main col-lg-9 col-md-8" role="main">
                        <div class="entry-content" itemprop="mainContentOfPage" itemscope="" itemtype="https://schema.org/WebPageElement">
                            <h3>Good Morning Arizona!</h3>
                            <p>1998 Good Morning Arizona Interview I did, explaining some of the benefits of hypnotherapy. Wow I look different 27 years later but the information I discuss is the same.</p>
                            <p><iframe width="560" height="315" style="max-width:100%;" src="https://www.youtube.com/embed/I1Y8JHzCork?si=fOzecZldiTO0EPqA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe></p>
                            
                            {{-- <h4>The Joy of Living Radio Show</h4>
                            <p><a href="http://www.blogtalkradio.com/the-joy-of-wealthy-living/2012/06/07/the-joy-of-wealthy-living-gues-danny-cabrera" target="_blank" rel="noopener" style="color: #efe2b3;">Listen to my guest appearance</a>
                                with Dr. Williamson on her show The Joy Of Living as we discuss the many ways how hypnotherapy can help your life.</p>
                            
                            <h4>Direct Links Video Show</h4>
                            <p><a href="http://terishardy.blogspot.com/2012/06/danny-cabrera-now-voyager-hypnotherapy.html" target="_blank" rel="noopener" style="color: #efe2b3;">Watch my guest appearance with Teri Shardi</a> on her show Direct Links. We discuss many ways, including using hypnotherapy, to better manage stress in our lives.</p>
        
                            <h4>Light Works USA Radio Show</h4>
                            <p><a href="http://www.blogtalkradio.com/roselouise/2013/07/25/revealing-hidden-ways-of-being-that-blocks-abundance" target="_blank" rel="noopener" style="color: #efe2b3;">Listen to my guest appearance with Rose Louise</a> on her show Light Worker’s USA. We discuss the topic of the Conscious and Sub-Conscious mind, and how hypnotherapy can help the two work better together</p> --}}
        
                            {{-- <h4>Published Articles</h4>
                            <p>I’ve had the honor to have several articles published in magazines over the years. You can <a href="https://nowvoyagercounselinghypnosis.com/category/media" target="_blank" rel="noopener" style="color: #580069  ;">find my published articles here</a>.</p> --}}
                        </div>
                    </div><!-- /.main -->
        
                    <aside class="col-lg-3 col-md-4 kad-sidebar" role="complementary" itemscope="" itemtype="https://schema.org/WPSideBar">
                        <div class="sidebar">
                            <section id="media_image-2" class="widget-1 widget-first widget widget_media_image">
                                <div class="widget-inner">
                                    <img width="360" height="360" src="{{ asset('front-assets/image/123.jpg') }}" class="image wp-image-485 attachment-full size-full" alt="Now, Voyager Counseling Hypnosis" style="max-width: 100%; height: auto;" decoding="async" loading="lazy">
                                </div>
                                <div class="center" style=" display: flex; justify-content: center;">
                                    <img class="aligncenter size-thumbnail wp-image-545"
                                        src="{{ asset('front-assets/image/honored-listee.png') }}"
                                        alt="Honored Listee" width="200" height="200">
                                </div>
                            </section>

                               
             
        
                            {{-- 
                            <section id="kadence_recent_posts-3" class="widget-4 widget kadence_recent_posts">
                                <div class="widget-inner">
                                    <h3>Recent Blog Posts</h3>
                                    <ul>
                                        @foreach($recentBlogs as $blog)
                                            <li class="clearfix postclass">
                                                <a href="{{ route('front.show', $blog->slug) }}" title="{{ $blog->title }}" class="recentpost_featimg">
                                                    @if ($blog->image)
                                                        <img width="80" height="50" src="{{ asset('uploads/blogs/'.$blog->image) }}" class="attachment-widget-thumb size-widget-thumb wp-post-image" alt="{{ $blog->title }}" decoding="async" loading="lazy">
                                                    @else
                                                        <img width="80" height="50" src="{{ asset('assets/image/placeholder.jpg') }}" class="attachment-widget-thumb size-widget-thumb wp-post-image" alt="Default image" decoding="async" loading="lazy">
                                                    @endif
                                                </a>
                                                <a href="{{ route('front.show', $blog->slug) }}" title="{{ $blog->title }}" class="recentpost_title">{{ Str::limit($blog->title, 50, '...') }}</a>
                                                <span class="recentpost_date">{{ $blog->created_at->format('F d, Y') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section> 
                            --}}
        
                        </div><!-- /.sidebar -->
                    </aside><!-- /aside -->
                </div><!-- /.row-->
            </div><!-- /.content -->
        </div><!-- end mt-5 mb-5 wrapper -->
        

@endsection