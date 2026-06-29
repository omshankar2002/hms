@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Appointment</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
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
            <h1 class="font-1 m-0">Appointment</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <div class="section bg-light-color" style="background-color: white">
        <div class="r-container">
            <div class="row row-cols-lg-2 row-cols-1">
                <div class="col col-lg-5">
                    <div class="d-flex flex-column gap-3 h-100 justify-content-center">
                        <span class="fw-semibold">APPOINTMENT</span>
                        <h3 class="font-1 fw-semibold">Book An Appointment</h3>
                      
                        <ul class="list gap-3 text-black">
                          
                            <li>
                                <a href="tel:602-301-6551" class="phone-link">
                                    <span class="d-flex flex-row align-items-center gap-3" style="font-size: 25px;">
                                        <i class="fa-solid fa-phone"></i>
                                        602-301-6551
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="mailto:dc@nowvoyagerhypnotherapy.com">
                                    <span class="d-flex flex-row align-items-center gap-3">
                                        <i class="fa-solid fa-envelope"></i>
                                        dc@NowVoyagerHypnotherapy.com
                                    </span>
                                </a>
                            </li>

                              <li>
                                <a href="https://www.google.co.in/maps/place/822+E+McLellan+Blvd,+Phoenix,+AZ+85014,+USA/@33.5330344,-112.0644535,17z/data=!3m1!4b1!4m6!3m5!1s0x872b6d4d1a18c517:0x46fd56526f5e71c4!8m2!3d33.53303!4d-112.0618786!16s%2Fg%2F11c16m0xj3?entry=ttu&g_ep=EgoyMDI1MDMxMC4wIKXMDSoASAFQAw%3D%3D"
                                    target="_blank">
                                    <span class="d-flex flex-row align-items-center gap-3">
                                        <i class="fa-solid fa-location-dot"></i>
                                        822 E McLellan Blvd, Phoenix, AZ 85014, United States
                                    </span>
                                </a>
                            </li>
                        
                        </ul>

                        <div class="center" style=" display: flex; justify-content: left;">
                            <img class="aligncenter size-thumbnail wp-image-545"
                                src="{{ asset('front-assets/image/honored-listee.png') }}" alt="Honored Listee"
                                width="200" height="200">
                        </div>
                    </div>

                </div>
                <div class="col col-lg-7">
                    <div class="position-relative">
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="liveToast" class="toast success_msg_appointment bg-dark-transparent text-white"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">

                                    <button type="button" class="btn me-2 m-auto text-white" data-bs-dismiss="toast"
                                        aria-label="Close">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 w-100 bg-white shadow rounded-3">
                            <div class="d-flex flex-column gap-3 p-lg-4">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <div>
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
                                            <input class="form-control" id="contact-email" type="email"
                                                name="contact-email" placeholder="Email" required />
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
