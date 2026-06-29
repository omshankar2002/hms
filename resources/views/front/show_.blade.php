@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Blog - {{ $blog->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Blogs</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
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
            <h1 class="font-1 m-0">Blog - {{ $blog->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Blogs</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <div class="section">
        <div class="r-container">
            <div class="row">
                <!-- First Column -->
                <div class="col-lg-8">
                    <div class="d-flex flex-column gap-4">
                        <div class="mb-3">
                            {{-- Make image responsive and match content width --}}
                           <img src="{{ asset('uploads/blogs/original/' . $blog->image) }}" alt="{{ $blog->title }}"
     class="img-fluid w-100 rounded-3"
     style="max-height: 1400px; object-fit: cover;">
                        </div>
                        <div class="mb-3">
                            <h1 class="font-1">{{ $blog->title }}</h1>
                            <div class="d-flex flex-row gap-5 accent-color">
                                <div class="d-flex flex-row align-items-center gap-2">
                                    <i class="fa-solid fa-user"></i>
                                    By Admin
                                </div>
                                {{-- <div class="d-flex flex-row align-items-center gap-2">
                                    <i class="fa-solid fa-calendar-alt"></i>
                                    {{ $blog->created_at->format('M d, Y') }}
                                </div> --}}
                            </div>
                        </div>

                        <div class="mb-3">

                            <div class="blog-description" style="color: inherit;">
                                <style>
                                    .blog-description a {
                                        color: #81d742 !important;
                                    }
                                </style>

                                {!! $blog->description !!}
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-4">
                        <div class="border border-accent-color rounded-3 py-5 px-4 d-flex flex-column gap-3">
                            <h5 class="font-1">Recent News</h5>
                            <div class="d-flex flex-column gap-4">
                                <!-- Loop through the recent blogs (now limited to 4) -->
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

                        <div class="position-relative overflow-hidden rounded-3"
                            style="background-image: url(image/image-600x400-8.jpg); background-size: cover; background-position: center;">
                            <div class="image-overlay"></div>
                            <div class="position-relative p-5" style="z-index: 2;">
                                <div class="d-flex flex-column mx-auto text-center align-items-center text-white gap-4">
                                    <h4 class="font-1 fw-semibold">Mental Health Support Anytime, Anywhere</h4>
                                    <div>
                                        <a href="#" class="btn btn-white-accent px-4 py-3 fw-semibold">BOOK
                                            APPOINTMENT</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12 mb-5">
                <div class="p-5 w-100 bg-white shadow rounded-3">
                    <h4>Send a message</h4>
                    <div class="d-flex flex-column gap-3 p-lg-4">
                        <div>
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <!-- Contact Form -->
                            <form class="..." id="contactForm" action="{{ route('front.sendContactEmail') }}"
                                method="POST">
                                @csrf
                                <input type="text" name="action" value="appointment" hidden>
                                <div class="mb-3">
                                    <label for="contact-name" class="form-label">Name *</label>
                                    <input class="form-control" id="contact-name" type="text" name="contact-name"
                                        placeholder="Name" required />
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="contact-email" class="form-label">Email *</label>
                                    <input class="form-control" id="contact-email" type="email" name="contact-email"
                                        placeholder="Email" required />
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>

                                <div class="row row-cols-2">
                                    <div class="col mb-3">
                                        <label for="contact-phone" class="form-label">Phone *</label>
                                        <input class="form-control" id="contact-phone" type="text"
                                            name="contact-phone" placeholder="Phone" required />
                                        <div class="invalid-feedback" id="name-error"></div>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="service" class="form-label">Services *</label>
                                        <select name="service" id="service" class="form-control"
                                            aria-label="Default select example" required>
                                            <option disabled selected>Select Service</option>
                                            <option value="Improve Test Taking Ability">Improve Test Taking
                                                Ability
                                            </option>
                                            <option value="Pain Modification">Pain Modification</option>
                                            <option value="Anxiety or Depression">Anxiety or Depression
                                            </option>
                                            <option value="Low Self-Esteem">Low Self-Esteem</option>
                                            <option value="Migraine and Tension Headaches">Migraine and
                                                Tension
                                                Headaches</option>
                                            <option value="Phobias or Other Fears">Phobias or Other Fears
                                            </option>
                                            <option value="Stress Management">Stress Management</option>
                                            <option value="Sports Improvement">Sports Improvement</option>
                                            <option value="Weight Control">Weight Control</option>
                                            <option value="Sleep Disorders">Sleep Disorders</option>
                                            <option value="Relationships">Relationships</option>
                                            <option value="Prosperity">Prosperity</option>
                                            <option value="Refresh Memory">Refresh Memory</option>
                                            <option value="Alcohol and Drug Abuse Recovery">Alcohol and Drug
                                                Abuse
                                                Recovery</option>
                                            <option value="Smoking Cessation">Smoking Cessation</option>
                                            <option value="Past Life Regression Therapy">Past Life
                                                Regression
                                                Therapy</option>
                                        </select>
                                        <div class="invalid-feedback" id="name-error"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="contact-message" class="form-label">Details *</label>
                                    <textarea class="form-control" id="contact-message" name="contact-message" rows="3"
                                        placeholder="Write your message" required></textarea>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">When is the best time to contact you?
                                        *</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="morning"
                                            name="contact_time[]" value="Morning">
                                        <label class="form-check-label" for="morning">Morning</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="afternoon"
                                            name="contact_time[]" value="Afternoon">
                                        <label class="form-check-label" for="afternoon">Afternoon</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="evening"
                                            name="contact_time[]" value="Evening">
                                        <label class="form-check-label" for="evening">Evening</label>
                                    </div>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>

                                <button class="btn btn-accent submit_appointment justify-content-center py-3"
                                    type="submit">
                                    Book Appointment
                                </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    </div>
@endsection


@section('customJs')
    <script>
        $("#contactForm").submit(function(event) {
            event.preventDefault();
            $("#form-submit").prop('disabled', true);
            $.ajax({
                url: '{{ route('front.sendContactEmail') }}', // यहाँ route नाम का उपयोग
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("#form-submit").prop('disabled', false);

                    if (response.status == true) {
                        window.location.href = '{{ route('front.appointment') }}';
                    } else {
                        var errors = response.errors;

                        // Handling validation for 'contact-name'
                        if (errors['contact-name']) {
                            $("#contact-name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['contact-name']);
                        } else {
                            $("#contact-name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handling validation for 'contact-email'
                        if (errors['contact-email']) {
                            $("#contact-email").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['contact-email']);
                        } else {
                            $("#contact-email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handling validation for 'contact-phone'
                        if (errors['contact-phone']) {
                            $("#contact-phone").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['contact-phone']);
                        } else {
                            $("#contact-phone").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handling validation for 'service'
                        if (errors['service']) {
                            $("#service").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['service']);
                        } else {
                            $("#service").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handling validation for 'contact-message'
                        if (errors['contact-message']) {
                            $("#contact-message").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['contact-message']);
                        } else {
                            $("#contact-message").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        // Handling validation for 'contact_time' (Checkbox group)
                        if (errors['contact_time']) {
                            // Assuming 'contact_time' is an array of selected values
                            // You may need to adjust how you handle checkbox errors depending on your backend validation.
                            $("input[name='contact_time[]']").each(function() {
                                if (errors['contact_time'].includes($(this).val())) {
                                    $(this).addClass('is-invalid');
                                } else {
                                    // Reset all error states first
                                    $('.is-invalid').removeClass('is-invalid');
                                    $('.invalid-feedback').html('');

                                    // Handle all errors dynamically
                                    $.each(errors, function(field, messages) {
                                        const fieldId = field === 'contact_time' ?
                                            'input[name="contact_time[]"]' :
                                            `#${field.replace('_', '-')}`;

                                        // Special handling for checkbox group
                                        if (field === 'contact_time') {
                                            $(fieldId).addClass('is-invalid');
                                            $('#contact_time-error').html(messages[
                                                0
                                            ]); // Add an error display element for checkboxes
                                        } else {
                                            const input = $(fieldId);
                                            input.addClass('is-invalid');
                                            input.siblings('.invalid-feedback').html(
                                                messages[0]);
                                        }
                                    });
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>
@endsection
