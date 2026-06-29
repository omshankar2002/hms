@extends('front.layouts.hotel')
@section('title', 'FAQs - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Frequently Asked Questions</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>FAQs</li>
        </ul>
    </div>
</section>

<!-- FAQs Section -->
<section style="padding:80px 0; background:#f8f5f0;">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="sec-title title-anim text-center mb-5">
                    <div class="sec-title_title">HELP CENTER</div>
                    <h2 class="sec-title_heading">Common Questions</h2>
                </div>

                @if($faqs->count() > 0)
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $key => $faq)
                    <div style="background:#fff; border-radius:6px; margin-bottom:12px; box-shadow:0 2px 10px rgba(0,0,0,0.05); overflow:hidden;">
                        <div style="padding:0;">
                            <button class="btn btn-link w-100 text-left d-flex justify-content-between align-items-center"
                                    style="padding:20px 25px; color:#1a1a2e; font-size:15px; font-weight:600; text-decoration:none; border:none; background:transparent;"
                                    type="button" data-toggle="collapse" data-target="#faq{{ $faq->id }}"
                                    aria-expanded="{{ $key === 0 ? 'true' : 'false' }}">
                                <span>{{ $faq->question }}</span>
                                <i class="fa fa-chevron-down" style="color:#c9a96e; transition:transform 0.3s; flex-shrink:0; margin-left:10px;"></i>
                            </button>
                        </div>
                        <div id="faq{{ $faq->id }}" class="collapse {{ $key === 0 ? 'show' : '' }}" data-parent="#faqAccordion">
                            <div style="padding:0 25px 20px; color:#666; font-size:14px; line-height:1.8; border-top:1px solid #f0ebe2;">
                                <div style="padding-top:15px;">{!! $faq->answer !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- Default FAQs -->
                @php
                $defaultFaqs = [
                    ['q'=>'What time is check-in and check-out?','a'=>'Check-in is from 2:00 PM and check-out is until 11:00 AM. Early check-in and late check-out may be available upon request, subject to availability.'],
                    ['q'=>'Is breakfast included in the room rate?','a'=>'Breakfast inclusion depends on the room package you select. Please check the specific room details during booking or contact us for more information.'],
                    ['q'=>'Do you have airport transfer service?','a'=>'Yes, we offer airport transfer services. Please contact us at least 24 hours in advance to arrange a pickup or drop-off.'],
                    ['q'=>'What is your cancellation policy?','a'=>'Cancellations made 24 hours before check-in receive a full refund. Cancellations made within 24 hours of check-in may incur a charge of one night\'s stay.'],
                    ['q'=>'Is Wi-Fi available throughout the hotel?','a'=>'Yes, complimentary high-speed Wi-Fi is available in all rooms and throughout the hotel property.'],
                    ['q'=>'Do you allow pets?','a'=>'We have a pet-friendly policy in designated rooms. Please inform us when booking if you plan to bring a pet. Additional charges may apply.'],
                ];
                @endphp
                <div class="accordion" id="faqAccordion">
                    @foreach($defaultFaqs as $idx => $faq)
                    <div style="background:#fff; border-radius:6px; margin-bottom:12px; box-shadow:0 2px 10px rgba(0,0,0,0.05); overflow:hidden;">
                        <div>
                            <button class="btn btn-link w-100 text-left d-flex justify-content-between align-items-center"
                                    style="padding:20px 25px; color:#1a1a2e; font-size:15px; font-weight:600; text-decoration:none; border:none; background:transparent;"
                                    type="button" data-toggle="collapse" data-target="#dfaq{{ $idx }}"
                                    aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                                <span>{{ $faq['q'] }}</span>
                                <i class="fa fa-chevron-down" style="color:#c9a96e; flex-shrink:0; margin-left:10px;"></i>
                            </button>
                        </div>
                        <div id="dfaq{{ $idx }}" class="collapse {{ $idx === 0 ? 'show' : '' }}" data-parent="#faqAccordion">
                            <div style="padding:0 25px 20px; color:#666; font-size:14px; line-height:1.8; border-top:1px solid #f0ebe2;">
                                <div style="padding-top:15px;">{{ $faq['a'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Still have questions -->
                <div style="background:#1a1a2e; padding:35px; border-radius:8px; margin-top:40px; text-align:center;">
                    <h4 style="color:#c9a96e; margin-bottom:10px;">Still Have Questions?</h4>
                    <p style="color:#aaa; margin-bottom:20px;">Our team is available 24/7 to assist you with any questions.</p>
                    <a href="{{ route('front.contact') }}" class="theme-btn btn-style-one" style="border:none;">
                        <span class="btn-wrap">
                            <span class="text-one">Contact Us <i class="fa-solid fa-arrow-right"></i></span>
                            <span class="text-two">Contact Us <i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
