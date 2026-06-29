@extends('front.layouts.app')

@php
    $popup = \App\Models\Popup::first();
@endphp

@if ($popup && $popup->is_active)
    <!-- Modal -->
   <div class="modal fade" id="homepageModal" tabindex="-1"
     style="display: none; background-color: rgba(0, 0, 0, 0.6);" aria-modal="true" role="dialog">

        <div class="modal-dialog modal-dialog-centered square-modal-dialog">
            <div class="modal-content square-modal-content overflow-hidden">
                
                <!-- Header -->
          <div class="modal-header text-white justify-content-center position-relative" style="background-color: #580069;">
    <h4 class="modal-title m-0 text-center w-100">Special Offer</h4>
    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" aria-label="Close" onclick="closePopup()"></button>
</div>

                <!-- Body -->
                <div class="modal-body d-flex flex-column justify-content-center text-center">
                    <p class="fs-4 px-2 mb-0">{{ $popup->message }}</p>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-center" style="background-color: #580069;">
                    <button type="button" class="btn btn-light btn-lg px-4" onclick="closePopup()">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Style -->
    <style>
        .square-modal-dialog {
            max-width: 400px;
            width: 100%;
        }

        .square-modal-content {
            height: 400px;
            border-radius: 12px;
        }

        @media (max-width: 450px) {
            .square-modal-content {
                height: 90vw;
            }
        }
    </style>

   <script>
    function closePopup() {
        const modal = document.getElementById('homepageModal');
        modal.classList.remove('show');
        modal.style.display = 'none';
    }

    window.addEventListener('load', function () {
        const modal = document.getElementById('homepageModal');

        if (modal) {
            // Show popup after 10 seconds
            setTimeout(() => {
                modal.classList.add('show');
                modal.style.display = 'block';
            }, 10000);
        }
    });
</script>

@endif

@section('content')
    <div class="hero-banner-wrapper">
        <img src="{{ asset('front-assets/image/home.jpg') }}" alt="Hero" class="hero-img">

        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index:1;">
        </div>

        <div class="hero-content text-white text-center">
            <h1 class="font-2">Welcome To Now, Voyager Counseling Hypnosis</h1>
            <span class="font-1 banner-heading d-block mt-2">Your Mind Is The Greatest Vessel</span>
            <p class="mt-3">Think what you want, not what you don't want!</p>
            <a href="{{ route('front.appointment') }}" class="btn btn-accent btn-white-outline-hover px-4 py-3 mt-4">
                BOOK APPOINTMENT
            </a>
        </div>
    </div>

    <div class="section">
        <div class="r-container">
            <div class="row row-cols-lg-2 row-cols-1">
                <div class="col pe-lg-5 mb-3 animate__animated animate__slideInLeft">
                    <div class="d-flex flex-column gap-4 pe-lg-5">
                        <!-- <span class="fw-semibold">ABOUT US</span> -->
                        <h3 class="font-1 fw-semibold">About Danny A. Cabrera C.Ht.</h3>
                        <div class="d-flex flex-column text-gray">
                            <p>
                                Danny Cabrera has always had a passion for helping others. He knew as a young boy that he
                                wanted to help other people improve their lives, and counseling was a natural career path
                                for him. Danny first became interested in psychology and counseling through the classic
                                Hollywood movie Now, Voyager. Until seeing this film Danny, the young boy, had no idea there
                                was such a thing as a career in counseling and psychology.
                            </p>
                            <p>
                                Now, Voyager is a story of a woman Charlotte Vale, played by Bette Davis, whose life is in
                                disarray and crisis. She is at the verge of a nervous breakdown. She crosses life’s paths
                                with a psychiatrist Dr. Jaquith, played by Claude Rains. Through care and counseling Dr.
                                Jaquith changes Charlotte’s life from dismay and sadness to a life filled with love, joy and
                                adventure.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('front.about') }}"
                                class="btn btn-accent-outline px-5 py-3 rounded-3 fw-semibold">READ MORE</a>
                        </div>
                    </div>
                </div>
                <div class="col position-relative ps-lg-5 pb-lg-5 animate__animated animate__slideInRight">
                    <div class="ps-lg-5 pb-lg-5">
                        <img src="{{ asset('front-assets/image/client.jpg') }}" alt="image"
                            class="img-fluid rounded-3 w-100 mb-lg-0 mb-3">
                        <div class="position-lg-absolute start-0 bottom-0">
                            <ul class="list-flush-horizontal bg-accent-2 rounded-4 custom-border text-white p-3">
                                <li class="list-item py-3 px-4">
                                    <div
                                        class="d-flex flex-row gap-3 align-items-center justify-content-center justify-content-lg-start">
                                        <div class="fs-1">
                                            <i style="color: #580069;" class="fa-solid fa-award"></i>
                                        </div>
                                        <div>
                                            <h4 style="color: #580069;" class="m-0 fw-semibold">
  <span class="count" style="font-size: inherit; font-weight: inherit;" data-target="30">0</span><sup>+</sup>
</h4>
                                            <span style="color: #580069;">Years Experience</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-item py-3 px-4">
                                    <div
                                        class="d-flex flex-row gap-3 align-items-center justify-content-center justify-content-lg-start">
                                        <div class="fs-1">
                                            <i style="color: #580069;" class="fa-solid fa-user-group"></i>
                                        </div>
                                        <div>
                                            <h4 style="color: #580069;" class="m-0 fw-semibold">
  <span class="count" style="font-size: inherit; font-weight: inherit;" data-target="97">0</span><sup>%+</sup>
</h4>
                                            <span style="color: #580069;">Happy Client</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-item py-3 px-4">
                                    <div
                                        class="d-flex flex-row gap-3 align-items-center justify-content-center justify-content-lg-start">
                                        <div class="fs-1">
                                            <i style="color: #580069;" class="fa-solid fa-award"></i>
                                        </div>
                                        <div>
                                            <h4 style="color: #580069;" class="m-0 fw-semibold">
  <span class="count" style="font-size: inherit; font-weight: inherit;" data-target="6000">0</span><sup>+</sup>
</h4>
                                            <span style="color: #580069;">Lives Changed</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section bg-light-color px-0">
        <div class="row row-cols-1 row-cols-lg-2 p-0 position-relative">
            <div class="col position-relative px-0" style="min-height: 320px;">
                <img src="{{ asset('front-assets/image/why-us.jpg') }}" alt=""
                    class="img-fluid w-100 h-100 object-fit-cover position-absolute top-0 start-0 blur-bg"
                    style="z-index: 0;">

                <div class="position-relative z-1 d-flex justify-content-center align-items-center h-100 px-4 py-4">
                    <div class="ratio ratio-16x9 w-100 w-md-75 w-lg-75 rounded-4 overflow-hidden custom-border">
                        <iframe src="https://www.youtube.com/embed/I1Y8JHzCork?rel=0" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="col me-auto" style="max-width: 720px;">
                <div class="d-flex flex-column gap-4 px-4 py-4">
                    <span class="fw-semibold">WHY CHOOSE ME ?</span>
                    <h3 class="font-1 fw-semibold">Committed to Your Mental Well Being</h3>

                    <div class="d-flex flex-column gap-4">
                        @php
                            $skills = [
                                ['label' => 'Confidentiality', 'value' => 99],
                                ['label' => 'Customer Satisfaction', 'value' => 98],
                                ['label' => 'Therapy', 'value' => 98],
                                ['label' => 'Counseling', 'value' => 90],
                            ];
                        @endphp

                        @foreach ($skills as $skill)
                            <div class="r-progress w-100" style="--value:{{ $skill['value'] }};">
                                <span class="font-1 fw-semibold fs-4">{{ $skill['label'] }}</span>
                                <div class="progress-container mt-2">
                                    <div class="r-progress-bar percentage-label">
                                        <div class="progress-value"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $latestServices = $services->where('status', 1)->sortByDesc('id')->take(4);
    @endphp

    <div class="section">
        <div class="r-container d-flex flex-column gap-4 ">
            <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;">
                <span class="fw-semibold">SERVICES</span>
                <h3 class="font-1 fw-semibold">Your Mental Health Is Our Priority</h3>
            </div>

            <div class="row row-cols-lg-4 row-cols-1 mb-4 animate__animated animate__slideInLeft ">
                @foreach ($latestServices as $service)
                    <div class="col mb-3">
                        <div class="card p-4 d-flex flex-column justify-content-start text-center shadow h-100">

                            <div class="text-center mb-4">
                                <i class="{{ $service->icon }}" style="font-size: 4rem ; color: #81d742;"></i>
                            </div>

                            <h5 class="font-1 fw-semibold mb-0" style="min-height: 48px; line-height: 24px;">
                                {{ $service->title }}
                            </h5>

                            <p class="text-gray mt-4 mb-0">
                                {{ Str::limit(strip_tags($service->description), 300) }}
                            </p>

                            {{-- Optional Read More --}}
                            {{-- <a href="#" class="link accent-color mt-3">Read More <i class="fa-solid fa-arrow-right"></i></a> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('front.services') }}" class="btn btn-accent-outline px-5 py-3 rounded-3 fw-semibold">
                    SEE ALL SERVICES
                </a>
            </div>
        </div>
    </div>


    <div class="section position-relative bg-attach-fixed"
        style="background-image: url({{ asset('front-assets/image/book-appointment.jpg') }});">
        <div class="image-overlay"></div>
        <div class="r-container position-relative" style="z-index: 2;">
            <div class="d-flex flex-column mx-auto text-center align-items-center text-white gap-4"
                style="max-width: 867px;">
                <h3 class="font-1 fw-semibold">Mental Health Support Anytime, Anywhere!</h3>

                <div>
                    <a href="{{ route('front.appointment') }}" class="btn btn-white-accent px-4 py-3 fw-semibold">BOOK
                        APPOINTEMENT</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section px-0">
        <div class="row row-cols-lg-2 row-cols-1 p-0">
            <div class="col position-relative ps-0 pe-5 mb-3 animate__animated animate__slideInLeft">
                <div class="mb-5 pb-5 pe-5">
                    <img src="{{ asset('front-assets/image/how-works.jpg') }}" alt=""
                        class="img-fluid rounded-3 shadow-accent-2">
                </div>
                <div class="position-absolute bottom-0 end-0 me-3">
                    <div
                        class="d-flex flex-column gap-1 px-5 py-4 custom-border rounded-4 bg-accent-2 text-center text-white animate__animated animate__slideInLeft">
                        <div class="fs-1">
                            <i class="fa-solid fa-award" style="color: #580069; "></i>
                        </div>
                        <h4 class="m-0 fw-semibold" style="color: #580069; ">30<sup>+</sup></h4>
                        <span style="color: #580069; ">Years Experience</span>
                    </div>
                </div>
            </div>
            <div class="col me-auto" style="max-width: 720px;">
                <div class="d-flex flex-column gap-4 px-5 ">
                    <span class="fw-semibold">HOW IT WORKS ?</span>
                    <h3 class="font-1 fw-semibold">We Have Solutions For Your Problem</h3>

                 <ul class="list gap-4">
    <li>
        <div class="d-flex flex-row gap-3 align-items-center animate__animated animate__slideInRight" style="animation-delay: 0.2s;">
            <div class="icon-box bg-accent-color fw-bold text-white">1</div>
            <div><h5 class="font-1 fw-bold m-0">Make An Appointment</h5></div>
        </div>
    </li>
    <li>
        <div class="d-flex flex-row gap-3 align-items-center animate__animated animate__slideInRight" style="animation-delay: 0.4s;">
            <div class="icon-box bg-accent-color fw-bold text-white">2</div>
            <div><h5 class="font-1 fw-bold m-0">Consultation</h5></div>
        </div>
    </li>
    <li>
        <div class="d-flex flex-row gap-3 align-items-center animate__animated animate__slideInRight" style="animation-delay: 0.6s;">
            <div class="icon-box bg-accent-color fw-bold text-white">3</div>
            <div><h5 class="font-1 fw-bold m-0">Counseling</h5></div>
        </div>
    </li>
    <li>
        <div class="d-flex flex-row gap-3 align-items-center animate__animated animate__slideInRight" style="animation-delay: 0.8s;">
            <div class="icon-box bg-accent-color fw-bold text-white">4</div>
            <div><h5 class="font-1 fw-bold m-0">Result</h5></div>
        </div>
    </li>
</ul>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="section">
    <div class="r-container d-flex flex-column gap-4">
        <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;"> --}}
    {{-- <span class="fw-semibold">Latest BLOGS</span> --}}
    {{-- <h3 class="font-1 fw-semibold">Latest Blogs</h3>
              </div>

        <div class="row row-cols-lg-3 row-cols-1 mb-4">
            @foreach ($blogs->take(3) as $blog)  <!-- Limit to 3 blogs here --> --}}
    {{-- <div class="col mb-3">
                <div class="border border-accent-color rounded-3 overflow-hidden"> --}}
    <!-- Display blog image or placeholder -->
    {{-- @if ($blog->image)
                        <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="image" class="img-fluid">
                    @else
                        <img src="{{ asset('assets/image/placeholder.jpg') }}" alt="Default image" class="img-fluid">
                    @endif

                    <div class="py-4 px-5 d-flex flex-column gap-3"> --}}
    {{-- <div class="d-flex flex-row gap-2 align-items-center accent-color">
                            <i class="fa-solid fa-calendar-alt"></i>
                            {{ $blog->created_at->format('F, d Y') }}
                        </div> --}}
    {{-- <div class="mb-3"> --}}
    <!-- Blog Title -->
    {{-- <a href="{{ route('front.show', $blog->slug) }}" class="text-black font-1 fs-4 lh-1 fw-semibold">
                                {{ Str::limit($blog->title, 60, '...') }}
                            </a>
                        </div>
                        <div class="blog-excerpt"> --}}
    <!-- Blog Content Excerpt -->
    {{-- {!! Str::limit(strip_tags($blog->content), 120, '...') !!}
                        </div>
                        <div>
                            <a href="{{ route('front.show', $blog->slug) }}" class="link accent-color py-3">
                                READ MORE <i class="fa-solid fa-arrow-right px-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> --}}

    {{-- </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('front.blogs') }}" class="btn btn-accent-outline px-5 py-3 rounded-3 fw-semibold">
                More Blogs
            </a>
        </div>
</div> --}}
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll(".count");

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute("data-target");
                const current = +counter.innerText.replace(/[^\d]/g, '');
                const increment = target / 100;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };

            updateCount();
        });
    });
</script>
