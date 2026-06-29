@extends('front.layouts.hotel')
@section('title', 'Contact Us - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Contact Us</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Contact</li>
        </ul>
    </div>
</section>

<!-- Contact Section -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="row">

            <!-- Contact Form -->
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div style="background:#fff; padding:40px; border-radius:8px; box-shadow:0 5px 30px rgba(0,0,0,0.06);">
                    <h3 style="color:#1a1a2e; margin-bottom:8px;">Send Us A Message</h3>
                    <p style="color:#666; margin-bottom:30px;">We'd love to hear from you. Fill out the form below and we'll get back to you promptly.</p>

                    @if(session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif

                    <form id="contactForm" action="{{ route('front.sendContactEmail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="contact">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Full Name *</label>
                                <input type="text" id="contact-name" name="contact-name" class="form-control"
                                       placeholder="Your full name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Email Address *</label>
                                <input type="email" id="contact-email" name="contact-email" class="form-control"
                                       placeholder="your@email.com" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Phone Number *</label>
                                <input type="tel" id="contact-phone" name="contact-phone" class="form-control"
                                       placeholder="+91 XXXXX XXXXX" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control"
                                       placeholder="Subject of your message">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Enquiry Type *</label>
                                <select id="service" name="service" class="form-control" required>
                                    <option value="" disabled selected>Select enquiry type</option>
                                    <option value="Room Booking">Room Booking</option>
                                    <option value="Event / Conference">Event / Conference</option>
                                    <option value="Restaurant Reservation">Restaurant Reservation</option>
                                    <option value="Spa & Wellness">Spa & Wellness</option>
                                    <option value="General Enquiry">General Enquiry</option>
                                    <option value="Feedback">Feedback</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label style="font-weight:600; color:#333; font-size:13px;">Message *</label>
                                <textarea id="contact-message" name="contact-message" class="form-control"
                                          rows="5" placeholder="How can we help you?" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label style="font-weight:600; color:#333; font-size:13px; display:block;">Best Time to Reach You *</label>
                                <div class="d-flex gap-4 mt-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="contact_time[]" value="Morning" id="morning">
                                        <label class="form-check-label" for="morning">Morning</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="contact_time[]" value="Afternoon" id="afternoon">
                                        <label class="form-check-label" for="afternoon">Afternoon</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="contact_time[]" value="Evening" id="evening">
                                        <label class="form-check-label" for="evening">Evening</label>
                                    </div>
                                </div>
                                <div class="text-danger" id="contact_time-error" style="font-size:13px;"></div>
                            </div>
                        </div>
                        <button type="submit" class="theme-btn btn-style-one" id="form-submit" style="border:none; padding:14px 40px;">
                            <span class="btn-wrap">
                                <span class="text-one">Send Message <i class="fa-solid fa-paper-plane"></i></span>
                                <span class="text-two">Send Message <i class="fa-solid fa-paper-plane"></i></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div style="background:#1a1a2e; padding:40px; border-radius:8px; color:#fff; margin-bottom:25px;">
                    <h4 style="color:#c9a96e; margin-bottom:25px;">Get In Touch</h4>
                    @isset($socialLink)
                        @if($socialLink->phone)
                        <div class="d-flex align-items-start mb-4">
                            <div style="width:45px; height:45px; background:rgba(201,169,110,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:15px; flex-shrink:0;">
                                <i class="fa fa-phone" style="color:#c9a96e;"></i>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#aaa; margin-bottom:4px; text-transform:uppercase; letter-spacing:1px;">Phone</div>
                                <a href="tel:{{ $socialLink->phone }}" style="color:#fff; text-decoration:none; font-size:16px; font-weight:600;">{{ $socialLink->phone }}</a>
                            </div>
                        </div>
                        @endif
                        @if($socialLink->gmail)
                        <div class="d-flex align-items-start mb-4">
                            <div style="width:45px; height:45px; background:rgba(201,169,110,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:15px; flex-shrink:0;">
                                <i class="fa fa-envelope" style="color:#c9a96e;"></i>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#aaa; margin-bottom:4px; text-transform:uppercase; letter-spacing:1px;">Email</div>
                                <a href="mailto:{{ $socialLink->gmail }}" style="color:#fff; text-decoration:none; font-size:15px;">{{ $socialLink->gmail }}</a>
                            </div>
                        </div>
                        @endif
                        @if($socialLink->address)
                        <div class="d-flex align-items-start mb-4">
                            <div style="width:45px; height:45px; background:rgba(201,169,110,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:15px; flex-shrink:0;">
                                <i class="fa fa-map-marker-alt" style="color:#c9a96e;"></i>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#aaa; margin-bottom:4px; text-transform:uppercase; letter-spacing:1px;">Address</div>
                                <span style="color:#ccc; font-size:15px;">{{ $socialLink->address }}</span>
                            </div>
                        </div>
                        @endif
                    @endisset
                    <div class="d-flex align-items-start">
                        <div style="width:45px; height:45px; background:rgba(201,169,110,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:15px; flex-shrink:0;">
                            <i class="fa fa-clock" style="color:#c9a96e;"></i>
                        </div>
                        <div>
                            <div style="font-size:12px; color:#aaa; margin-bottom:4px; text-transform:uppercase; letter-spacing:1px;">Reception Hours</div>
                            <span style="color:#ccc; font-size:15px;">24 Hours / 7 Days</span>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div style="border-radius:8px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.08);">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.0!2d77.5946!3d12.9716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDU4JzE3LjgiTiA3N8KwMzUnNDAuNiJF!5e0!3m2!1sen!2sin!4v1000000000000!5m2!1sen!2sin"
                        width="100%" height="250" style="border:0;" loading="lazy" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
$("#contactForm").submit(function(event) {
    event.preventDefault();
    $("#form-submit").prop('disabled', true);

    $.ajax({
        url: '{{ route('front.sendContactEmail') }}',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            $("#form-submit").prop('disabled', false);
            $(".is-invalid").removeClass('is-invalid');
            $(".invalid-feedback").html('');
            $('#contact_time-error').html('');

            if (response.status === true) {
                alert('Thank you! Your message has been sent successfully.');
                $("#contactForm")[0].reset();
            } else if (response.errors) {
                $.each(response.errors, function(field, messages) {
                    const fieldId = field.replace(/_/g, '-');
                    const input = $(`#${fieldId}`);
                    if (field === 'contact_time') {
                        $('#contact_time-error').html(messages[0]);
                    } else if (input.length) {
                        input.addClass('is-invalid');
                        input.siblings('.invalid-feedback').html(messages[0]);
                    }
                });
            }
        },
        error: function(xhr) {
            $("#form-submit").prop('disabled', false);
            alert('Something went wrong! Please try again.');
        }
    });
});
</script>
@endsection
