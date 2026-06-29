<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title', 'Grand Hotel - Luxury Hospitality')</title>
<!-- Stylesheets -->
<link href="{{ asset('hotel-assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('hotel-assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('hotel-assets/css/meanmenu.min.css') }}" rel="stylesheet">
<link href="{{ asset('hotel-assets/css/responsive.css') }}" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

<link href="{{ asset('hotel-assets/css/color-switcher-design.css') }}" rel="stylesheet">
<link id="theme-color-file" href="{{ asset('hotel-assets/css/color-themes/default-color.css') }}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('hotel-assets/images/favicon.png') }}" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('extraCss')
</head>

<body>
<div class="page-wrapper">

    <!-- Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Preloader -->
    <div class="preloader hoteling">
        <div class="preloader-content">
            <div class="preloader-text">Grand Hotel</div>
            <div class="loading-bar"><span></span></div>
        </div>
    </div>

    <!-- Body Lines -->
    <div class="body-lines">
        <div class="auto-container">
            <span class="line"><span class="dot"></span></span>
            <span class="line"><span class="dot"></span></span>
            <span class="line"><span class="dot"></span></span>
            <span class="line"><span class="dot"></span></span>
            <span class="line"><span class="dot"></span></span>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header header-style-one">
        <div class="header-lower">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="d-flex justify-content-between align-items-center">

                        <!-- Logo -->
                        <div class="logo-box">
                            <div class="logo">
                                <a href="{{ route('front.home') }}">
                                    <img src="{{ asset('hotel-assets/images/logo.png') }}" alt="Grand Hotel" title="Grand Hotel">
                                </a>
                            </div>
                        </div>

                        <div class="header-navbar d-flex justify-content-between align-items-center">
                            <div class="nav-outer d-flex flex-wrap">
                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md">
                                    <div class="navbar-header">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class="{{ request()->routeIs('front.home') ? 'current' : '' }}">
                                                <a href="{{ route('front.home') }}">Home</a>
                                            </li>
                                            <li class="{{ request()->routeIs('front.about') ? 'current' : '' }}">
                                                <a href="{{ route('front.about') }}">About</a>
                                            </li>
                                            <li class="{{ request()->routeIs('front.rooms*') ? 'current' : '' }} dropdown">
                                                <a href="{{ route('front.rooms') }}">Rooms</a>
                                                <ul>
                                                    <li><a href="{{ route('front.rooms') }}">All Rooms</a></li>
                                                    <li><a href="{{ route('front.booking') }}">Book Now</a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ request()->routeIs('front.services') ? 'current' : '' }}">
                                                <a href="{{ route('front.services') }}">Services</a>
                                            </li>
                                            <li class="{{ request()->routeIs('front.blogs*') ? 'current' : '' }} dropdown">
                                                <a href="{{ route('front.blogs') }}">Blog</a>
                                                <ul>
                                                    <li><a href="{{ route('front.blogs') }}">All Posts</a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ request()->routeIs('front.contact') ? 'current' : '' }}">
                                                <a href="{{ route('front.contact') }}">Contact</a>
                                            </li>
                                            <li class="{{ request()->routeIs('front.myBooking*') ? 'current' : '' }}">
                                                <a href="{{ route('front.myBooking') }}">My Booking</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>

                            <!-- Header Buttons -->
                            <div class="outer-box d-flex align-items-center flex-wrap">
                                <div class="search-box-btn trans-500 search-box-outer">
                                    <span class="icon fa fa-search"></span>
                                </div>
                                <span class="about-widget">
                                    <span class="hamburger">
                                        <span class="top-bun"></span>
                                        <span class="meat"></span>
                                        <span class="bottom-bun"></span>
                                    </span>
                                </span>
                                <div class="main-header_button">
                                    <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one">
                                        <span class="btn-wrap">
                                            <span class="text-one">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                                            <span class="text-two">Book Now <i class="fa-solid fa-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon fa-xmark"></span></div>
            <nav class="menu-box">
                <div class="nav-logo">
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('hotel-assets/images/mobile-logo.png') }}" alt="Grand Hotel">
                    </a>
                </div>
                <div class="menu-outer"><!-- Menu loads here via JS --></div>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <!-- About Sidebar -->
    <div class="about-sidebar">
        <div class="gradient-layer"></div>
        <div class="close-sidebar-widget close-button">
            <span class="fa-solid fa-xmark fa-fw"></span>
        </div>
        <div class="sidebar-inner">
            <div class="upper-box">
                <div class="image">
                    <img src="{{ asset('hotel-assets/images/resource/about-1.jpg') }}" alt="">
                </div>
                <div class="content-box">
                    <h3>About <span>Grand Hotel</span></h3>
                    <div class="text">Experience luxury and comfort at their finest. Our hotel offers world-class amenities and exceptional service for an unforgettable stay.</div>
                    <ul class="about-sidebar_list">
                        <li>Restaurant & Bar</li>
                        <li>Swimming Pool</li>
                        <li>Party Planning</li>
                        <li>Conference Room</li>
                        <li>Spa & Wellness</li>
                    </ul>
                </div>
            </div>
            <div class="social-box">
                @isset($socialLink)
                    @if($socialLink->facebook)<a href="{{ $socialLink->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>@endif
                    @if($socialLink->youtube)<a href="{{ $socialLink->youtube }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>@endif
                    @if($socialLink->instagram)<a href="{{ $socialLink->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>@endif
                @endisset
            </div>
        </div>
    </div>
    <!-- End About Sidebar -->

    <!-- Page Content -->
    @yield('content')
    <!-- End Page Content -->

    <!-- Main Footer -->
    <footer class="main-footer style-two">
        <div class="footer_pattern"></div>
        <div class="auto-container">
            <div class="inner-container">
                <!-- Widgets Section -->
                <div class="widgets-section">
                    <div class="row clearfix">
                        <!-- About Column -->
                        <div class="big-column col-lg-6 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="footer_column col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-widget about-widget">
                                        <div class="footer-logo">
                                            <a href="{{ route('front.home') }}">
                                                <img src="{{ asset('hotel-assets/images/logo.png') }}" alt="Grand Hotel" style="max-height:60px;">
                                            </a>
                                        </div>
                                        <div class="footer-text">Experience luxury and comfort at its finest. Your perfect getaway awaits.</div>
                                        @isset($socialLink)
                                        <div class="footer-social_box">
                                            <strong>Follow Us</strong>
                                            @if($socialLink->facebook)<a href="{{ $socialLink->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>@endif
                                            @if($socialLink->instagram)<a href="{{ $socialLink->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>@endif
                                            @if($socialLink->youtube)<a href="{{ $socialLink->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>@endif
                                            @if($socialLink->linkedin)<a href="{{ $socialLink->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>@endif
                                        </div>
                                        @endisset
                                    </div>
                                </div>
                                <div class="footer_column col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h3 class="footer-title">Pages</h3>
                                        <ul class="footer-list">
                                            <li><a href="{{ route('front.home') }}">Home</a></li>
                                            <li><a href="{{ route('front.about') }}">About Us</a></li>
                                            <li><a href="{{ route('front.rooms') }}">Our Rooms</a></li>
                                            <li><a href="{{ route('front.services') }}">Services</a></li>
                                            <li><a href="{{ route('front.blogs') }}">Blog</a></li>
                                            <li><a href="{{ route('front.faqs') }}">FAQs</a></li>
                                            <li><a href="{{ route('front.contact') }}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Services & Newsletter Column -->
                        <div class="big-column col-lg-6 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="footer_column col-lg-7 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h3 class="footer-title">Services</h3>
                                        <ul class="footer-list">
                                            <li><a href="{{ route('front.services') }}">Restaurant & Bar</a></li>
                                            <li><a href="{{ route('front.services') }}">Swimming Pool</a></li>
                                            <li><a href="{{ route('front.services') }}">Spa & Wellness</a></li>
                                            <li><a href="{{ route('front.services') }}">Conference Room</a></li>
                                            <li><a href="{{ route('front.services') }}">Room Service</a></li>
                                            <li><a href="{{ route('front.services') }}">Airport Transfer</a></li>
                                            <li><a href="{{ route('front.services') }}">Laundry Service</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="footer_column col-lg-5 col-md-6 col-sm-12">
                                    <div class="footer-widget newsletter-widget">
                                        <h3 class="footer-title">Newsletter</h3>
                                        <div class="footer-text">Subscribe to get special offers and updates.</div>
                                        <div class="newsletter-box">
                                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="email" name="email" placeholder="Your Email Address" required>
                                                    <button type="submit"><span class="fa fa-paper-plane"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Widgets Section -->
            </div>
        </div>

        <div class="footer-bottom">
            <div class="auto-container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="main-footer_copyright">
                        Copyright &copy; {{ date('Y') }} Grand Hotel. All Rights Reserved.
                        Developed by <a href="https://wamexs.com/" target="_blank">Wamexs</a>
                    </div>
                    <ul class="footer-bottom_navs">
                        <li><a href="{{ route('front.terms-&-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('front.privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Search Popup -->
    <div class="search-popup">
        <div class="color-layer"></div>
        <button class="close-search"><span class="fa-xmark"></span></button>
        <form method="get" action="{{ route('front.blogs') }}">
            <div class="form-group">
                <input type="search" name="search" value="" placeholder="Search Here" required="">
                <button class="fa fa-solid fa-magnifying-glass fa-fw" type="submit"></button>
            </div>
        </form>
    </div>

    <!-- Color Switcher -->
    <div class="color-palate">
        <div class="color-trigger"><i class="fa fa-solid fa-gear fa-fw"></i></div>
        <div class="color-palate-inner">
            <div class="color-palate-head"><h6>Choose Theme</h6></div>
            <div class="various-color clearfix">
                <div class="colors-list">
                    <span class="palate default-color active" data-theme-file="{{ asset('hotel-assets/css/color-themes/default-color.css') }}"></span>
                    <span class="palate blue-color"    data-theme-file="{{ asset('hotel-assets/css/color-themes/blue-color.css') }}"></span>
                    <span class="palate olive-color"   data-theme-file="{{ asset('hotel-assets/css/color-themes/olive-color.css') }}"></span>
                    <span class="palate orange-color"  data-theme-file="{{ asset('hotel-assets/css/color-themes/orange-color.css') }}"></span>
                    <span class="palate purple-color"  data-theme-file="{{ asset('hotel-assets/css/color-themes/purple-color.css') }}"></span>
                    <span class="palate green-color"   data-theme-file="{{ asset('hotel-assets/css/color-themes/green-color.css') }}"></span>
                    <span class="palate brown-color"   data-theme-file="{{ asset('hotel-assets/css/color-themes/brown-color.css') }}"></span>
                    <span class="palate yellow-color"  data-theme-file="{{ asset('hotel-assets/css/color-themes/yellow-color.css') }}"></span>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End page-wrapper -->

<!-- Scripts -->
<script src="{{ asset('hotel-assets/js/jquery.js') }}"></script>
<script src="{{ asset('hotel-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/appear.js') }}"></script>
<script src="{{ asset('hotel-assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/wow.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('hotel-assets/js/backtotop.js') }}"></script>
<script src="{{ asset('hotel-assets/js/odometer.js') }}"></script>
<script src="{{ asset('hotel-assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/SplitText.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/ScrollSmoother.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/isotope.js') }}"></script>
<script src="{{ asset('hotel-assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('hotel-assets/js/nav-tool.js') }}"></script>
<script src="{{ asset('hotel-assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('hotel-assets/js/element-in-view.js') }}"></script>
<script src="{{ asset('hotel-assets/js/color-settings.js') }}"></script>
<script src="{{ asset('hotel-assets/js/script.js') }}"></script>

@yield('customJs')
</body>
</html>
