<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.camionthemes.com/warevo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Oct 2025 12:22:26 GMT -->

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/scrollCue.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/office-location.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/responsive.css') }}">

    <!-- Site Title & Favicon -->
    <title>
        Warevo - Logistics And Transportation Service HTML Template
    </title>
    <link rel="shortcut icon" href="{{ asset('front-assets/images/favicon.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner">
            <div class="spinner-circle"></div>
        </div>
    </div>
    <!-- End -->

    <!-- Header Area Start -->
    <div class="header-area border-bottom">
        <div class="container-fluid defaul-padding">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    <ul class="header-list ps-0 pe-0 mb-0 list-unstyled d-flex align-items-center gap-4">
                        @isset($socialLink)
                            @if ($socialLink->phone)
                                <li class="d-flex align-items-center gap-2">
                                    <i class="ri-phone-line"></i>
                                    <a href="tel:{{ $socialLink->phone }}">{{ $socialLink->phone }}</a>
                                </li>
                            @endif

                            @if ($socialLink->gmail)
                                <li class="d-flex align-items-center gap-2">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:{{ $socialLink->gmail }}">{{ $socialLink->gmail }}</a>
                                </li>
                            @endif

                            @if ($socialLink->time)
                                <li class="d-flex align-items-center gap-2">
                                    <i class="ri-time-line"></i>
                                    <span>{{ $socialLink->time }}</span>
                                </li>
                            @endif
                        @endisset
                    </ul>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    @isset($socialLink)
                        <ul
                            class="social-icons ps-0 pe-0 mb-0 list-unstyled d-flex align-items-center justify-content-end gap-2">
                            <li>
                                <span class="fw-medium tex pe-xl-1">Follow us:</span>
                            </li>

                            @if ($socialLink->facebook)
                                <li>
                                    <a href="{{ $socialLink->facebook }}" target="_blank">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socialLink->youtube)
                                <li>
                                    <a href="{{ $socialLink->youtube }}" target="_blank">
                                        <i class="ri-youtube-line"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socialLink->linkedin)
                                <li>
                                    <a href="{{ $socialLink->linkedin }}" target="_blank">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socialLink->instagram)
                                <li>
                                    <a href="{{ $socialLink->instagram }}" target="_blank">
                                        <i class="ri-instagram-line"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endisset

                </div>
            </div>
        </div>
    </div>
    <!-- Header Area End -->

    <!-- Navbar Area Start -->
    <nav class="navbar navbar-expand-lg border-bottom" id="navbar">
        <div class="container-fluid defaul-padding position-relative">
            <a class="navbar-brand p-0" href="index.html">
                <img src="{{ asset('front-assets/images/logo.png') }}" alt="logo">
            </a>
            <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button"
                aria-controls="offcanvasRight">
                <span class="burger-menu">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </span>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.about') }}">
                            About
                        </a>
                    </li>


                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Pages
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="about-us.html">
                                    About Us
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle dropdown-item" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" href="#">
                                    Team
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="team.html">Team Members</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="team-details.html">Team Details</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="testimonials.html">
                                    Testimonials
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pricing.html">
                                    Pricing Plan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="categories.html">
                                    Categories
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="faq.html">
                                    FAQ's
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="privacy-policy.html">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="terms-conditions.html">
                                    Terms & Conditions
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="404-error.html">
                                    404 Error
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.services') }}">
                            Services
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.faqs') }}">
                            Faqs
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.testimonials') }}">
                            Testimonials
                        </a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Projects
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="projects.html">
                                    Projects
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="project-details.html">
                                    Project Details
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.blogs') }}">
                            Blogs
                        </a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.contact') }}">
                            Contact Us
                        </a>
                    </li> --}}
                </ul>
            </div>

            <div class="others-options">
                <ul class="d-flex align-items-center shrink-0 ps-0 pe-0 mb-0 list-unstyled">
                    <li>
                        <a href="{{ route('front.contact') }}" class="global-btn">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar Area End -->

    <!-- Start Mobile Menu -->
    <div class="side-modal mobile-navbar offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="mobile-menu">
                <li class="mobile-menu-list Active">
                    <a href="{{ route('front.home') }}">Home</a>
                </li>

                <li class="mobile-menu-list Active">
                    <a href="{{ route('front.about') }}">About</a>
                </li>

                {{-- <li class="mobile-menu-list">
                    <a href="javascript:void(0);"> Pages </a>

                    <ul class="mobile-menu-items">
                        <li>
                            <a class="dropdown-item" href="about-us.html">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="testimonials.html">
                                Testimonials
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pricing.html">
                                Pricing Plan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="categories.html">
                                Categories
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="contact-us.html">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="faq.html">
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="privacy-policy.html">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="terms-conditions.html">
                                Terms & Conditions
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="404-error.html">
                                404 Error
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="mobile-menu-list Active">
                    <a href="{{ route('front.services') }}">Services</a>
                </li>

                <li class="mobile-menu-list Active">
                    <a href="{{ route('front.faqs') }}">Faqs</a>
                </li>

                <li class="mobile-menu-list Active">
                    <a href="{{ route('front.testimonials') }}">Testimonials</a>
                </li>
                {{-- <li class="mobile-menu-list">
                    <a href="javascript:void(0);"> Projects </a>

                    <ul class="mobile-menu-items">
                        <li>
                            <a class="dropdown-item" href="projects.html">
                                Projects
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="project-details.html">
                                Project Details
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="mobile-menu-list">
                    <a href="javascript:void(0);"> Team </a>

                    <ul class="mobile-menu-items">
                        <li>
                            <a class="dropdown-item" href="team.html">
                                Team Members
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="team-details.html">
                                Team Details
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="mobile-menu-list">
                    <a href="javascript:void(0);"> Blog </a>

                    <ul class="mobile-menu-items">
                        <li>
                            <a class="dropdown-item" href="blog.html">
                                Our Blog
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="blog-details.html">
                                Blog Details
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="others-options">
                <ul class="d-flex align-items-center shrink-0 ps-0 pe-0 mb-0 list-unstyled">
                    <li>
                        <a href="contact-us.html" class="global-btn">Track Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Mobile Menu -->

    <main>
        @yield('content')
    </main>


    <!-- Footer Area Start -->
    <div class="footer-area px-120 bg-013b48">
        <div class="container-fluid defaul-padding">
            <div class="row" data-cues="slideInUp" data-duration="700">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="footer-weight">
                        <a href="index.html">
                            <img class="footer-logo mb-40" src="{{ asset('front-assets/images/white-logo.png') }}"
                                alt="Image">
                        </a>
                        <p class="text-white pb-4 mb-4 border-bottom">
                            He either secures greater pleasures, or he
                            endures lesser pains to avoid ones.
                        </p>
                        @isset($socialLink)
                            <ul class="link-items list-unstyled ps-0 pe-0 mb-4">
                                @if ($socialLink->phone)
                                    <li class="d-flex align-items-center gap-2">
                                        <i class="ri-phone-line fs-20 pi"></i>
                                        <a href="tel:{{ $socialLink->phone }}"
                                            class="text-white">{{ $socialLink->phone }}</a>
                                    </li>
                                @endif

                                @if ($socialLink->gmail)
                                    <li class="d-flex align-items-center gap-2">
                                        <i class="ri-mail-line fs-20 pi"></i>
                                        <a href="mailto:{{ $socialLink->gmail }}"
                                            class="text-white">{{ $socialLink->gmail }}</a>
                                    </li>
                                @endif

                                @if ($socialLink->address)
                                    <li class="d-flex align-items-center gap-2">
                                        <i class="ri-map-pin-line fs-20 pi"></i>
                                        <a href="https://www.google.co.in/maps/place/822+E+McLellan+Blvd,+Phoenix,+AZ+85014,+USA/@33.5330344,-112.0644535,17z"
                                            target="_blank" class="text-white">
                                            {{ $socialLink->address }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endisset

                        @isset($socialLink)
                            <ul class="social-icons ps-0 pe-0 mb-0 list-unstyled d-flex align-items-center gap-3">
                                @if ($socialLink->facebook)
                                    <li>
                                        <a href="{{ $socialLink->facebook }}" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($socialLink->youtube)
                                    <li>
                                        <a href="{{ $socialLink->youtube }}" target="_blank">
                                            <i class="ri-youtube-line"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($socialLink->linkedin)
                                    <li>
                                        <a href="{{ $socialLink->linkedin }}" target="_blank">
                                            <i class="ri-linkedin-fill"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($socialLink->instagram)
                                    <li>
                                        <a href="{{ $socialLink->instagram }}" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endisset

                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="footer-weight ps-xl-4 ps-xxl-5">
                        <h3 class="fs-25 lh-1 mb-40 text-white border-bottom pb-1 pb-xl-2 pb-xxl-3">
                            Services
                        </h3>
                        <ul class="list-items list-unstyled ps-0 pe-0 mb-0">
                            <li>
                                <a href="#" class="text-white">Warehouse Management</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Transportation Services</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Analytics & Reporting</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Security & Compliance</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">24/7 Operations</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Global Network</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="footer-weight ps-xl-4 ps-xxl-5">
                        <h3 class="fs-25 lh-1 mb-40 text-white border-bottom pb-1 pb-xl-2 pb-xxl-3">
                            Company
                        </h3>
                        <ul class="list-items list-unstyled ps-0 pe-0 mb-0">
                            <li>
                                <a href="{{ route('front.about') }}" class="text-white">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('front.services') }}" class="text-white">Services</a>
                            </li>
                            <li>
                                <a href="{{ route('front.faqs') }}" class="text-white">Faqs</a>
                            </li>
                            <li>
                                <a href="{{ route('front.testimonials') }}" class="text-white">Testimonials</a>
                            </li>
                            <li>
                                <a href="{{ route('front.contact') }}" class="text-white">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="footer-weight ps-xl-4 ps-xxl-5">
                        <h3 class="fs-25 lh-1 mb-40 text-white border-bottom pb-1 pb-xl-2 pb-xxl-3">
                            Support
                        </h3>
                        <ul class="list-items list-unstyled ps-0 pe-0 mb-40">
                            <li>
                                <a href="services.html" class="text-white">Help Center</a>
                            </li>
                            <li>
                                <a href="services.html" class="text-white">Documentation</a>
                            </li>
                            <li>
                                <a href="services.html" class="text-white">Contact Support</a>
                            </li>
                            <li>
                                <a href="services.html" class="text-white">Training</a>
                            </li>
                            <li>
                                <a href="services.html" class="text-white">API Reference</a>
                            </li>
                            <li>
                                <a href="services.html" class="text-white">System Status</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End -->

    <!-- Copyright Area Start -->
    <div class="copyright-area bg-013b48 py-4 py-lg-5 border-top">
        <div class="container">
            <div class="copyright text-center">
                <p class="text-white">
                    © All Rights Reserved
                  
                      Developed By  <a href="https://wamexs.com/" target="_blank" class="text-white fw-semibold"> WEB & MARKETING EXPERTS LLC
                    </a>
                </p>
            </div>
        </div>
    </div>
    <!-- Copyright Area End -->

    <!-- Go To btn Start -->
    <button class="back-to-top" aria-label="Back to Top">
        <i class="ri-arrow-up-fill"></i>
    </button>
    <!-- Go To btn End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS Files -->
    <script src="{{ asset('front-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/scrollCue.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/fslightbox.js') }}"></script>
    <script src="{{ asset('front-assets/js/script.js') }}"></script>

    @yield('customJs')
</body>

<!-- Mirrored from demos.camionthemes.com/warevo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Oct 2025 12:22:47 GMT -->

</html>
