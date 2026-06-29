@extends('front.layouts.app')

@section('content')
{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
            <h1 class="font-1 m-0">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <div class="section">
        <div class="r-container">
            <div class="row row-cols-lg-2 row-cols-1">
                <div class="col pe-lg-5 mb-3 animate__animated animate__slideInLeft">
                    <div class="d-flex flex-column gap-4 pe-lg-5 ">
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
                            <p>Inspired by this movie Danny earned a Psychology degree and a Counseling degree from Ottawa
                                University in Arizona and studied hypnosis from New Beginnings Wellness Institute in
                                Phoenix.</p>

                        </div>
                    </div>
                </div>
                <div class="col position-relative ps-lg-5 pb-lg-5 animate__animated animate__slideInRight">
                    <div class="ps-lg-5 pb-lg-5">
                        <img src="{{ asset('front-assets/image/client3.jpg') }}" alt="image"
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
                                        <div><h4 style="color: #580069;" class="m-0 fw-semibold">
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
            <div class="r-container ">
                <div class="d-flex flex-column text-gray">
                    <p>
                        He feels fortunate too, to have also studied and mentored under the tutelage of Dr. Edwin Druding, a
                        direct disciple of Milton Erickson, the father of modern hypnotherapy. Danny established his own
                        private practice in Phoenix Arizona in 1996 and has done extensive hypnosis work with Phoenix
                        Shanti, a former center for people with A.I.D.S./HIV and alcohol/drug rehabilitation.
                    </p>
                    <p>
                        In every aspect of his life, Danny promotes a holistic approach. He believes it takes the mind,
                        body, and spirt together to heal. He found hypnotherapy to be an excellent fit with his personal
                        philosophy. Using hypnosis as a tool to help you simply become more relaxed, Danny is better able to
                        connect with you and communicate with your subconscious, our operating power house aking it easier
                        to eliminate the underlying causes of depression, anxiety, phobias as other issues affecting our
                        human condition as well as supporting self-improvements and the ability to focus more clearly.
                    </p>
                    <p>
                        As a therapist, Danny believes that you have the power within yourself to change, no matter who you
                        are or what your circumstances have been. Once your conscious mind has made the decision to change,
                        hypnosis is a tool that can convince your subconscious mind to more easily embrace that change,
                        hence his slogan; Your Mind is the Greatest Vessel! Danny believes that you can move forward with
                        life in a positive productive manner, and he can help you find that path. Just as Dr. Jaquith did
                        with Charlotte Vale In the movie Now, Voyager.
                    </p>
                    <p>
                        If you or someone you know needs help moving forward, fill out the contact form or call him at <a
                            href="tel:602-301-6551">602-301-6551</a>.
                    </p>
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
        <div class="r-container d-flex flex-column gap-4">
            <div class="d-flex flex-column gap-4 mx-auto text-center mb-4" style="max-width: 867px;">
                <span class="fw-semibold">SERVICES</span>
                <h3 class="font-1 fw-semibold">Your Mental Health Is Our Priority</h3>
            </div>

            <div class="row row-cols-lg-4 row-cols-1 mb-4 animate__animated animate__slideInLeft">
                @foreach ($latestServices as $service)
                    <div class="col mb-3">
                        <div class="card p-4 d-flex flex-column justify-content-start text-center shadow h-100">

                            {{-- ICON --}}
                            <div class="text-center mb-4">
                                <i class="{{ $service->icon }}" style="font-size: 4rem ; color: #81d742;"></i>
                            </div>

                            {{-- TITLE --}}
                            <h5 class="font-1 fw-semibold mb-0" style="min-height: 48px; line-height: 24px;">
                                {{ $service->title }}
                            </h5>

                            {{-- DESCRIPTION --}}
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

    <div class="section">
        <div class="r-container">
            <div class="row row-cols-lg-2 row-cols-1 mb-5">
                <div class="col mb-3">
                    <div class="d-flex flex-column gap-3">
                        <span class="fw-semibold">TESTIMONIALS</span>
                        <h3 class="font-1 fw-semibold">What They Say About Us</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <!-- Slides -->
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="d-flex flex-column gap-3 p-4 shadow rounded-3">
                                    <ul class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <li><i class="fa-solid fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <p class="fst-italic">
                                        {{ $testimonial->comments }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row gap-3">
                                            {{-- <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}"
                                                alt="{{ $testimonial->name }}" class="img-fluid rounded-circle"
                                                width="70" height="70"> --}}
                                            <div class="d-flex flex-column h-100 justify-content-center">
                                                <span class="text-black">{{ $testimonial->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="https://www.google.com/search?q=Now+Voyager+Counseling+Hypnosis&sca_esv=d743d26c8a087e94&sca_upv=1&rlz=1C1JJTC_enIN1094IN1095&sxsrf=ADLYWIIuAd0Ff6zd45N9HT4Myll03_gR-A%3A1726164686891&ei=zi7jZq2UNq6O4-EPvcSS8Ac&ved=0ahUKEwits_HHgL6IAxUuxzgGHT2iBH4Q4dUDCA8&uact=5&oq=Now+Voyager+Counseling+Hypnosis&gs_lp=Egxnd3Mtd2l6LXNlcnAiH05vdyBWb3lhZ2VyIENvdW5zZWxpbmcgSHlwbm9zaXMyBRAhGKABSLMkUABYsyFwAXgAkAEAmAH2AaAB6QOqAQMyLTK4AQPIAQD4AQL4AQGYAgOgAvgDmAMA4gMFEgExIECSBwUxLjAuMqAHxAQ&sclient=gws-wiz-serp#lrd=0x872b128b70493055:0xbc641a71fc204750,1,,,,"
                target="_blank" class="btn btn-accent-outline px-5 py-3 rounded-3 fw-semibold">
                More Testimonials
            </a>
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
                    <a href="appointment.php" class="btn btn-white-accent px-4 py-3 fw-semibold">BOOK APPOINTEMENT</a>
                </div>
            </div>
        </div>
    </div>
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
