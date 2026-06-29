@extends('front.layouts.hotel')
@section('title', $roomType->name . ' - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>{{ $roomType->name }}</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li><a href="{{ route('front.rooms') }}">Rooms</a></li>
            <li>{{ $roomType->name }}</li>
        </ul>
    </div>
</section>

<!-- Room Detail -->
<section style="padding:80px 0;">
    <div class="auto-container">
        <div class="row">

            <!-- Main Content -->
            <div class="col-lg-8">

                <!-- Room Image -->
                <div style="margin-bottom:30px; border-radius:8px; overflow:hidden;">
                    <img src="{{ $roomType->image ? asset($roomType->image) : asset('hotel-assets/images/gallery/1.jpg') }}"
                         alt="{{ $roomType->name }}" style="width:100%; height:450px; object-fit:cover;">
                </div>

                <!-- Room Info -->
                <div style="background:#fff; padding:35px; box-shadow:0 5px 30px rgba(0,0,0,0.06); border-radius:8px; margin-bottom:30px;">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h2 style="color:#1a1a2e; margin:0;">{{ $roomType->name }}</h2>
                        <div style="background:#c9a96e; color:#fff; padding:10px 25px; font-size:20px; font-weight:700; border-radius:4px;">
                            ₹{{ number_format($roomType->base_price, 0) }} <span style="font-size:14px; font-weight:400;">/ night</span>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="row text-center mb-4" style="background:#f8f5f0; padding:20px; border-radius:6px;">
                        <div class="col-4">
                            <i class="fa fa-users fa-2x" style="color:#c9a96e; margin-bottom:8px; display:block;"></i>
                            <div style="font-size:13px; color:#666;">Max Adults</div>
                            <strong style="color:#1a1a2e;">{{ $roomType->max_adults }}</strong>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-child fa-2x" style="color:#c9a96e; margin-bottom:8px; display:block;"></i>
                            <div style="font-size:13px; color:#666;">Max Children</div>
                            <strong style="color:#1a1a2e;">{{ $roomType->max_children }}</strong>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-door-open fa-2x" style="color:#c9a96e; margin-bottom:8px; display:block;"></i>
                            <div style="font-size:13px; color:#666;">Available Rooms</div>
                            <strong style="color:{{ $roomType->availableRooms->count() > 0 ? '#27ae60' : '#e74c3c' }};">
                                {{ $roomType->availableRooms->count() }}
                            </strong>
                        </div>
                    </div>

                    <!-- Description -->
                    <h4 style="color:#1a1a2e; margin-bottom:15px;">About This Room</h4>
                    <div style="color:#666; line-height:1.8; margin-bottom:20px;">
                        {!! $roomType->description ?? 'Experience ultimate comfort and luxury in our beautifully appointed rooms. Each room is designed to provide a relaxing and memorable stay with top-class amenities and breathtaking views.' !!}
                    </div>

                    <!-- Amenities -->
                    <h4 style="color:#1a1a2e; margin-bottom:15px;">Room Amenities</h4>
                    <div class="row">
                        @foreach(['Free Wi-Fi', 'Air Conditioning', 'Flat Screen TV', 'Mini Bar', 'Room Service', 'Daily Housekeeping', 'Safe Box', 'Tea/Coffee Maker'] as $amenity)
                        <div class="col-md-6 mb-2">
                            <span style="color:#c9a96e; margin-right:8px;"><i class="fa fa-check-circle"></i></span>
                            <span style="color:#555; font-size:14px;">{{ $amenity }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Gallery -->
                <div style="background:#fff; padding:35px; box-shadow:0 5px 30px rgba(0,0,0,0.06); border-radius:8px;">
                    <h4 style="color:#1a1a2e; margin-bottom:20px;">Gallery</h4>
                    <div class="row">
                        @for($i = 1; $i <= 6; $i++)
                        <div class="col-4 mb-3">
                            <a href="{{ asset('hotel-assets/images/gallery/'.$i.'.jpg') }}" class="lightbox-image">
                                <img src="{{ asset('hotel-assets/images/gallery/'.$i.'.jpg') }}"
                                     style="width:100%; height:120px; object-fit:cover; border-radius:4px; cursor:pointer; transition:opacity 0.3s;"
                                     onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            </a>
                        </div>
                        @endfor
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">

                <!-- Quick Book Form -->
                <div style="background:#1a1a2e; padding:30px; border-radius:8px; margin-bottom:25px; position:sticky; top:20px;">
                    <h4 style="color:#c9a96e; margin-bottom:20px; text-align:center;">
                        <i class="fa fa-calendar-check mr-2"></i> Book This Room
                    </h4>
                    <form action="{{ route('front.booking') }}" method="GET">
                        <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                        <div class="form-group mb-3">
                            <label style="color:#ccc; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Check In</label>
                            <input type="date" name="check_in" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label style="color:#ccc; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Check Out</label>
                            <input type="date" name="check_out" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="form-group mb-4">
                            <label style="color:#ccc; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Adults</label>
                            <select name="adults" class="form-control">
                                <option>1</option><option selected>2</option><option>3</option>
                                @if($roomType->max_adults >= 4)<option>4</option>@endif
                            </select>
                        </div>
                        <div style="background:#f8f5f0; padding:15px; border-radius:6px; margin-bottom:15px;">
                            <div class="d-flex justify-content-between" style="color:#333; font-size:14px;">
                                <span>Price per night</span><strong>₹{{ number_format($roomType->base_price, 0) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between" style="color:#333; font-size:14px; margin-top:5px;">
                                <span>GST (12%)</span><strong>₹{{ number_format($roomType->base_price * 0.12, 0) }}</strong>
                            </div>
                        </div>
                        @if($roomType->availableRooms->count() > 0)
                            <button type="submit" class="theme-btn btn-style-one w-100" style="border:none; padding:14px;">
                                <span class="btn-wrap">
                                    <span class="text-one">Check Availability <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="text-two">Check Availability <i class="fa-solid fa-arrow-right"></i></span>
                                </span>
                            </button>
                        @else
                            <button type="button" class="btn w-100" style="background:#e74c3c; color:#fff; padding:14px; border-radius:0; cursor:not-allowed;">
                                <i class="fa fa-times-circle mr-2"></i> Not Available
                            </button>
                        @endif
                    </form>
                </div>

                <!-- Need Help -->
                <div style="background:#f8f5f0; padding:25px; border-radius:8px; text-align:center;">
                    <i class="fa fa-phone-volume fa-2x" style="color:#c9a96e; margin-bottom:12px; display:block;"></i>
                    <h5 style="color:#1a1a2e; margin-bottom:8px;">Need Help?</h5>
                    <p style="color:#666; font-size:14px; margin-bottom:12px;">Our team is available 24/7 to assist you.</p>
                    @isset($socialLink)
                        @if($socialLink->phone)
                            <a href="tel:{{ $socialLink->phone }}" style="color:#c9a96e; font-size:18px; font-weight:700; text-decoration:none;">
                                {{ $socialLink->phone }}
                            </a>
                        @endif
                    @endisset
                </div>

            </div>
        </div>

        <!-- Related Rooms -->
        @if($related->count() > 0)
        <div style="margin-top:60px;">
            <div class="sec-title title-anim">
                <div class="sec-title_title">EXPLORE MORE</div>
                <h2 class="sec-title_heading">Similar Rooms</h2>
            </div>
            <div class="row">
                @foreach($related as $r)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div style="background:#fff; box-shadow:0 5px 20px rgba(0,0,0,0.07); border-radius:6px; overflow:hidden;">
                        <img src="{{ $r->image ? asset($r->image) : asset('hotel-assets/images/gallery/'.($loop->iteration+3).'.jpg') }}"
                             alt="{{ $r->name }}" style="width:100%; height:200px; object-fit:cover;">
                        <div style="padding:20px;">
                            <h5 style="color:#1a1a2e;">{{ $r->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span style="color:#c9a96e; font-weight:700;">₹{{ number_format($r->base_price, 0) }}/night</span>
                                <a href="{{ route('front.room-detail', $r->slug) }}"
                                   style="background:#1a1a2e; color:#fff; padding:6px 15px; text-decoration:none; font-size:13px; border-radius:3px;">
                                   View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
