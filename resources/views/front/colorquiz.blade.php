@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Color Quiz</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Color Quiz</li>
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
            <h1 class="font-1 m-0">Color Quiz</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Color Quiz</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <div class="mt-5 mb-5">
        <div id="pageheader" class="titleclass">
            <div class="container">
                <div class="page-header">
                    <!-- <h1 class="entry-title" itemprop="name">
                          Color Quiz </h1> -->
                </div>
            </div><!-- container -->
        </div>

        <div id="content" class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row justify-content-center w-100">
                <div class="main col-lg-9 col-md-8" role="main">
                    <div class="entry-content" itemprop="mainContentOfPage" itemscope=""
                        itemtype="https://schema.org/WebPageElement">
                       <p class="text-center">
                            <a href="http://www.colorquiz.com" data-rel="lightbox" target="_blank">
                                <img decoding="async" class="aligncenter size-medium wp-image-157"
                                    src="{{ asset('front-assets/image/color-quiz-slider.jpg') }}"
                                    alt="Color Quiz | Now, Voyager Counseling Hypnosis"
                                    width="300" height="77">
                            </a>
                        </p>

                        <p class="text-center">&nbsp;</p>
                        <p class="text-center"
                            style="font-size: 24px; font-weight: 700; background-color: #81d742; padding: 1rem; border-radius: 8px; color: #000; animation: greenGlow 1.3s infinite;">
                            How are you doing today? Take this quick and easy test to find out.
                        </p>

                        <style>
                            @keyframes greenGlow {
                                0% {
                                    background-color: #81d742;
                                    box-shadow: 0 0 5px #81d742;
                                }

                                50% {
                                    background-color: #a6f75a;
                                    box-shadow: 0 0 25px #a6f75a;
                                }

                                100% {
                                    background-color: #81d742;
                                    box-shadow: 0 0 5px #81d742;
                                }
                            }
                        </style>
                        <br>
                        <p class="text-center">
                            <a href="http://www.colorquiz.com" target="_blank" rel="noopener">
                                <img decoding="async" class="aligncenter"
                                    src="{{ asset('front-assets/image/colorquizlogosmall2.gif') }}" alt=""
                                    border="0">
                            </a>
                        </p>

                        <p style="font-size: 20px">This test was designed at the early part of the 20<sup>th</sup> century
                            based on color Psychology (see below). I have placed it here on my website to provide you with
                            some insight into what is happening with you today.</p>

                        <p style="font-size: 20px">Keep in mind unlike many tests floating around the internet today, this
                            test has true psychological backing and meaning. It’s not just a “Just for fun test”. It can
                            provide you with sincere insight.</p>

                        <p style="font-size: 20px">When you realize you are ready to make changes in your life for the
                            better, contact me today through <a
                                href="https://nowvoyagercounselinghypnosis.com/contact-me">the online form</a> or call me
                            directly at <a href="tel:602-301-6551" style= "font-weight: 600">602-301-6551</a> to make an
                            appointment.</p>
                        <p><em>Danny</em></p>

                        <h2>About The Color Quiz</h2>

                        <p style="font-size: 20px">In the early 1900’s, Dr. Max Luscher studied how color affects behavior.
                            The Color Quiz uses his research as well as that of other color psychologists to identify how
                            certain colors cause an emotional response in people. Hundreds of thousands of test subjects
                            across the globe were studied in order to isolate how certain colors make us feel. Using the
                            colors people prefer, the Color Quiz can then gain some indicators about their current emotional
                            state.</p>

                        <p style="font-size: 20px">Keep in mind that tests like this one can have both long and short-term
                            results. If you’re feeling depressed about something when you take the test, this may be
                            reflected in your results. If you take the test a number of times, you might see deeper
                            conflicts showing themselves consistently. You can take the test frequently and still get
                            accurate results – even if the results aren’t the same each time. It’s like a snapshot of your
                            current emotional state.</p>

                        <p style="font-size: 20px"><strong>This is not a diagnosis</strong>, but can give you insight into
                            what might be troubling you. Please <a href="index.php" target="_blank" rel="noopener">call me
                                to schedule a consultation</a> for help with any issues you may have. <a
                                href="tel:602-301-6551" style= "font-weight: 600">602-301-6551</a></p>

                        <p>I’d love to hear your thoughts on the test. Go ahead and take <a
                                href="http://www.colorquiz.com/quiz.php" target="_blank" rel="noopener">the Color Quiz</a> –
                            do you find it reliable? <a href="https://www.facebook.com/nowvoyagerhypnotherapy?fref=ts"
                                target="_blank" rel="noopener">Comment on my Facebook page</a>.</p>
                    </div>
                </div><!-- /.main -->

                <aside class="col-lg-3 col-md-4 kad-sidebar" role="complementary" itemscope=""
                    itemtype="https://schema.org/WPSideBar">
                    <div class="sidebar">
                        <section id="media_image-2" class="widget-1 widget-first widget widget_media_image">
                            <div class="widget-inner">
                                <img width="360" height="360" src="{{ asset('front-assets/image/123.jpg') }}"
                                    class="image wp-image-485 attachment-full size-full"
                                    alt="Now, Voyager Counseling Hypnosis" style="max-width: 100%; height: auto;"
                                    decoding="async" loading="lazy">
                            </div>
                            <div class="center" style=" display: flex; justify-content: center;">
                                <img class="aligncenter size-thumbnail wp-image-545"
                                    src="{{ asset('front-assets/image/honored-listee.png') }}" alt="Honored Listee"
                                    width="200" height="200">
                            </div>
                        </section>




                        {{-- 
                      <section id="kadence_recent_posts-3" class="widget-4 widget kadence_recent_posts">
                          <div class="widget-inner">
                              <h3>Recent Blog Posts</h3>
                              <ul>
                                  @foreach ($recentBlogs as $blog)
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
                </aside>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    </div>
@endsection
