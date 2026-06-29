<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('front-assets/image/123.jpg') }}">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">


    <title>Now, Voyager Counseling Hypnosis</title>
</head>

<body>
    <!-- Scripts -->



    <!-- Header -->
    <div id="header" class="fixed-top bg-accent-opacity">
        <div class="r-container">
            <nav class="navbar navbar-expand-lg font-2" style="background: white;" id="navbar-spy">
                <div class="container-fluid">
                    <div class="logo-container">
                        <a class="navbar-brand" href="{{ route('front.home') }}">
                            <img src="{{ asset('front-assets/image/123.jpg') }}" alt=""
                                class="img-fluid glowing-image">
                        </a>
                    </div>



                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.home') ? 'active' : '' }}"
                                    href="{{ route('front.home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.about') ? 'active' : '' }}"
                                    href="{{ route('front.about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.services') ? 'active' : '' }}"
                                    href="{{ route('front.services') }}">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.products') ? 'active' : '' }}"
                                    href="{{ route('front.products') }}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.colorquiz') ? 'active' : '' }}"
                                    href="{{ route('front.colorquiz') }}">Color Quiz</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.faqs') ? 'active' : '' }}"
                                    href="{{ route('front.faqs') }}">FAQs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.blogs') ? 'active' : '' }}"
                                    href="{{ route('front.blogs') }}">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.media') ? 'active' : '' }}"
                                    href="{{ route('front.media') }}">Media</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('front.testimonials') ? 'active' : '' }}"
                                    href="{{ route('front.testimonials') }}">Testimonials</a>
                            </li>

                            @if (staticPages()->isNotEmpty())
                                @foreach (staticPages() as $page)
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('front.page') && request()->route('slug') === $page->slug ? 'active' : '' }}"
                                            href="{{ route('front.page', $page->slug) }}" title="{{ $page->name }}">
                                            {{ $page->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div>
                            <a href="{{ route('front.appointment') }}"
                                class="btn btn-white-accent px-4 py-3 fw-semibold"
                                style="
            background-color: #580069;
            color: #f9f5f3;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            animation: purpleGlow 1.3s infinite;
        ">
                                APPOINTMENT
                            </a>
                        </div>

                        <style>
                            @keyframes purpleGlow {
                                0% {
                                    background-color: #580069;
                                    box-shadow: 0 0 5px #580069;
                                }

                                50% {
                                    background-color: #6f0085;
                                    box-shadow: 0 0 20px #6f0085;
                                }

                                100% {
                                    background-color: #580069;
                                    box-shadow: 0 0 5px #580069;
                                }
                            }
                        </style>

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Header -->

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="section pb-0 bg-accent-color text-white">
            <div class="r-container">
                <div class="border-bottom pb-5">
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col col-lg-4 mb-3">
                            <div class="d-flex flex-column gap-3">
                                <a href="{{ route('front.home') }}" style="text-decoration: none;">
                                    <div class="footer-logo" style="width: 176px;">
                                        <img src="{{ asset('front-assets/image/123.jpg') }}" alt=""
                                            class="img-fluid glowing-image" width="160">
                                    </div>
                                </a>

                                <style>
                                    .glowing-image {
                                        display: inline-block;
                                        box-shadow: 0 0 5px #efe2b3;
                                        animation: glowing 1300ms infinite;
                                    }

                                    @keyframes glowing {
                                        0% {
                                            box-shadow: 0 0 5px #efe2b3;
                                        }

                                        50% {
                                            box-shadow: 0 0 15px #e1d7d1;
                                        }

                                        100% {
                                            box-shadow: 0 0 5px #efe2b3;
                                        }
                                    }
                                </style>

                                <p>
                                    Welcome to Now, Voyager Counseling Hypnosis. I'm Danny Cabrera, and I work every day
                                    to help people like you overcome a variety of issues. I have a degree in Psychology
                                    and a degree in Counseling from Ottawa University in Arizona... <a
                                        href="{{ route('front.about') }}" class="read-more-link"><strong>Read
                                            More</strong></a>

                                </p>
                                @if ($socialLink)
                                    <div class="social-container mb-lg-0 mb-3">
                                        @if ($socialLink->facebook)
                                            <a href="{{ $socialLink->facebook }}" target="_blank" class="social-item">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        @endif

                                        @if ($socialLink->youtube)
                                            <a href="{{ $socialLink->youtube }}" target="_blank" class="social-item">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        @endif

                                        @if ($socialLink->linkedin)
                                            <a href="{{ $socialLink->linkedin }}" target="_blank"
                                                class="social-item">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        @endif

                                        @if ($socialLink->google)
                                            <a href="{{ $socialLink->google }}" target="_blank" class="social-item">
                                                <i class="fa-brands fa-google"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>


                        <div class="col col-lg-8 mb-3">
                            <div class="row row-cols-lg-3 row-cols-1">
                                <!-- Quick Links -->
                                <div class="col mb-3">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="border-bottom pb-2 w-max-content pe-3">
                                            <h5 class="font-1">Quick Links</h5>
                                        </div>
                                        <ul class="list gap-3">
                                            <li>
                                                <a href="{{ route('front.home') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    Home
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('front.about') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    About Us
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('front.services') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    Services
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <!-- Useful Links -->
                                <div class="col mb-3">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="border-bottom pb-2 w-max-content pe-3">
                                            <h5 class="font-1">Useful Links</h5>
                                        </div>
                                        <ul class="list gap-3">
                                            {{-- <li>
                                                <a href="{{ route('front.privacy-policy') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    Privacy Policy
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('front.terms-&-conditions') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    Term & Services
                                                </a>
                                            </li> --}}
                                            <li>
                                                <a href="{{ route('front.faqs') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    FAQs
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('front.testimonials') }}"
                                                    class="footer-link d-flex flex-row gap-3 align-items-center">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    Testimonials
                                                </a>
                                            </li>

                                            @if (staticPages()->isNotEmpty())
                                                @foreach (staticPages() as $page)
                                                    <li>
                                                        <a href="{{ route('front.page', $page->slug) }}"
                                                            class="footer-link d-flex flex-row gap-3 align-items-center"
                                                            title="{{ $page->name }}">
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                            {{ $page->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>

                                <!-- Get In Touch -->
                                <div class="col mb-3">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="border-bottom pb-2 w-max-content pe-3">
                                            <h5 class="font-1">Get In Touch</h5>
                                        </div>

                                        @isset($socialLink)
                                            <ul class="list gap-3">


                                                @if ($socialLink->phone)
                                                    <li>
                                                        <a href="tel:{{ $socialLink->phone }}"
                                                            class="footer-link d-flex flex-row align-items-center gap-3"
                                                            style="font-size: 25px; font-weight: 1000">
                                                            <i class="fa-solid fa-phone"></i>
                                                            {{ $socialLink->phone }}
                                                        </a>
                                                    </li>
                                                @endif

                                                @if ($socialLink->gmail)
                                                    <li>
                                                        <a href="mailto:{{ $socialLink->gmail }}"
                                                            class="footer-link d-flex flex-row align-items-center gap-3">
                                                            <i class="fa-solid fa-envelope"></i>
                                                            {{ $socialLink->gmail }}
                                                        </a>
                                                    </li>
                                                @endif

                                                @if ($socialLink->address)
                                                    <li>
                                                        <a href="https://www.google.co.in/maps/place/822+E+McLellan+Blvd,+Phoenix,+AZ+85014,+USA/@33.5330344,-112.0644535,17z"
                                                            target="_blank"
                                                            class="footer-link d-flex flex-row align-items-center gap-3">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $socialLink->address }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endisset

                                        <!-- Newsletter -->
                                        <div id="newsletter" class="d-flex flex-column gap-3 mt-3" <h5
                                            class="font-1">Newsletter Signup</h5>
                                            <div>
                                                <form action="{{ route('newsletter.subscribe') }}" method="POST"
                                                    class="d-flex flex-column h-100 justify-content-center w-100 needs-validation form"
                                                    novalidate>
                                                    @csrf

                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control border-white"
                                                            placeholder="Your Email" name="email" required>
                                                        <button
                                                            class="btn btn-white-outline submit_subscribe border border-1 rounded-3 rounded-start-0"
                                                            type="submit">Subscribe</button>
                                                    </div>
                                                </form>
                                            </div>
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show mt-2"
                                                    role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible fade show mt-2"
                                                    role="alert">
                                                    {{ $errors->first('email') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-flex flex-lg-row flex-column gap-3 justify-content-center py-3">
                    <!-- <div class="d-flex flex-row gap-3 justify-content-center">
                    <a href="privacy-policy.php" class="link text-white fs-6">Privacy Policy</a>
                    |
                    <a href="terms-&-conditions.php" class="link text-white fs-6">Term & Services</a>
                </div> -->
                    <span class="text-center fs-6">
                        Copyright &copy;
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script>. All Rights Reserved. Developed By <a href="https://wamexs.com/"
                            target="_blank" class="footer-link">
                            WEB & MARKETING EXPERTS LLC
                        </a>
                    </span>
                </div>

            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('front-assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/script.js') }}"></script>
    <script src="{{ asset('front-assets/js/swiper-script.js') }}"></script>
    {{-- <script src="{{ asset('front-assets/js/submit-form.js') }}"></script> --}}
    <script src="{{ asset('front-assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/video_embedded.js') }}"></script>
    <script src="{{ asset('front-assets/js/vendor/fslightbox.js') }}"></script>
    <script src="{{ asset('front-assets/js/vendor/jquery.min.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://web.squarecdn.com/v1/square.js"></script>


    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar-spy");
        if (navbar) { // Add null check
            var sticky = navbar.offsetTop;
        }

        function myFunction() {
            if (!navbar) return; // Add safety check

            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addToCart(id) {
            $.ajax({
                url: '{{ route('front.addToCart') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('front.cart') }}";
                    } else {
                        alert(response.message);
                    }
                }
            });
        }

        function addToWishList(id) {
            $.ajax({
                url: '{{ route('front.addToWishlist') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {

                        $("#wishlistModal .modal-body").html(response.message);
                        $("#wishlistModal").modal('show');

                    } else {
                        window.location.href = "{{ route('account.login') }}";
                    }
                }
            });
        }

        @if (session('success') || $errors->any())

            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    const el = document.getElementById('newsletter');
                    if (el) {
                        el.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }, 300);
            });
        @endif
    </script>

    @yield('customJs')
</body>

</html>
