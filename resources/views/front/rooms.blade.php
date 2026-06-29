@extends('front.layouts.hotel')
@section('title', 'Our Rooms & Suites - Grand Hotel')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Rooms & Suites</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Rooms</li>
        </ul>
    </div>
</section>

<!-- Filter Bar -->
<section style="background:#f8f5f0; padding:25px 0; border-bottom:1px solid #e0d9cf;">
    <div class="auto-container">
        <form method="GET" action="{{ route('front.rooms') }}" class="row align-items-center g-3">
            <div class="col-md-3">
                <label style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:#666;">Min Price (₹/night)</label>
                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="0">
            </div>
            <div class="col-md-3">
                <label style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:#666;">Max Price (₹/night)</label>
                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="Any">
            </div>
            <div class="col-md-3">
                <label style="font-size:12px; text-transform:uppercase; letter-spacing:1px; color:#666;">Adults</label>
                <select name="adults" class="form-control">
                    <option value="">Any</option>
                    <option value="1" {{ request('adults')==1?'selected':'' }}>1</option>
                    <option value="2" {{ request('adults')==2?'selected':'' }}>2</option>
                    <option value="3" {{ request('adults')==3?'selected':'' }}>3</option>
                    <option value="4" {{ request('adults')==4?'selected':'' }}>4+</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2 align-items-end" style="padding-top:22px;">
                <button type="submit" class="theme-btn btn-style-one" style="border:none; padding:10px 25px;">
                    <span class="btn-wrap">
                        <span class="text-one">Filter</span>
                        <span class="text-two">Filter</span>
                    </span>
                </button>
                <a href="{{ route('front.rooms') }}" class="btn" style="background:#1a1a2e; color:#fff; padding:10px 20px; border-radius:0;">Reset</a>
            </div>
        </form>
    </div>
</section>

<!-- Rooms Grid -->
<section style="padding:80px 0;">
    <div class="auto-container">
        @if($roomTypes->count() > 0)
        <div class="row">
            @foreach($roomTypes as $rt)
            <div class="col-lg-4 col-md-6 mb-5 wow fadeInUp" data-wow-delay="{{ $loop->index * 100 }}ms">
                <div class="room-card" style="background:#fff; box-shadow:0 5px 30px rgba(0,0,0,0.08); border-radius:8px; overflow:hidden; height:100%;">
                    <div style="position:relative; overflow:hidden;">
                        <img src="{{ $rt->image ? asset($rt->image) : asset('hotel-assets/images/gallery/'.($loop->iteration).'.jpg') }}"
                             alt="{{ $rt->name }}"
                             style="width:100%; height:260px; object-fit:cover; transition:transform 0.5s ease;"
                             onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute; top:15px; right:15px; background:#c9a96e; color:#fff; padding:6px 14px; font-size:13px; font-weight:600; border-radius:4px;">
                            ₹{{ number_format($rt->base_price, 0) }}/night
                        </div>
                        @if($rt->available_rooms_count > 0)
                            <div style="position:absolute; top:15px; left:15px; background:#27ae60; color:#fff; padding:4px 12px; font-size:12px; border-radius:4px;">
                                {{ $rt->available_rooms_count }} Available
                            </div>
                        @else
                            <div style="position:absolute; top:15px; left:15px; background:#e74c3c; color:#fff; padding:4px 12px; font-size:12px; border-radius:4px;">
                                Fully Booked
                            </div>
                        @endif
                    </div>
                    <div style="padding:25px;">
                        <h4 style="color:#1a1a2e; margin-bottom:10px;">{{ $rt->name }}</h4>
                        <p style="color:#666; font-size:14px; margin-bottom:15px;">
                            {{ \Illuminate\Support\Str::limit(strip_tags($rt->description), 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-3" style="font-size:13px; color:#666;">
                            <span><i class="fa fa-user" style="color:#c9a96e;"></i> Max {{ $rt->max_adults }} Adults</span>
                            <span><i class="fa fa-child" style="color:#c9a96e;"></i> {{ $rt->max_children }} Children</span>
                            <span><i class="fa fa-bed" style="color:#c9a96e;"></i> {{ $rt->rooms_count }} Rooms</span>
                        </div>
                        <div style="border-top:1px solid #f0ebe2; padding-top:15px; display:flex; gap:10px;">
                            <a href="{{ route('front.room-detail', $rt->slug) }}"
                               style="flex:1; text-align:center; padding:10px; border:2px solid #1a1a2e; color:#1a1a2e; text-decoration:none; font-size:13px; font-weight:600; transition:all 0.3s;"
                               onmouseover="this.style.background='#1a1a2e';this.style.color='#fff'"
                               onmouseout="this.style.background='transparent';this.style.color='#1a1a2e'">
                               Details
                            </a>
                            <a href="{{ route('front.booking', ['room_type_id' => $rt->id]) }}"
                               class="theme-btn btn-style-one"
                               style="flex:1; text-align:center; border:none; padding:10px 10px;">
                               <span class="btn-wrap">
                                   <span class="text-one">Book Now</span>
                                   <span class="text-two">Book Now</span>
                               </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-bed fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No rooms available matching your criteria.</h4>
            <a href="{{ route('front.rooms') }}" class="theme-btn btn-style-one mt-3" style="border:none;">
                <span class="btn-wrap">
                    <span class="text-one">View All Rooms</span>
                    <span class="text-two">View All Rooms</span>
                </span>
            </a>
        </div>
        @endif
    </div>
</section>

@endsection
