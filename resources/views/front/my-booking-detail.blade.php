@extends('front.layouts.hotel')
@section('title', 'Booking ' . $booking->booking_number . ' - Grand Hotel')

@section('extraCss')
<style>
@media print {
    .main-header, .main-footer, .page-title, .no-print, .color-palate,
    .body-lines, .preloader, .cursor, .cursor-follower { display: none !important; }
    .print-area { padding: 0 !important; background: #fff !important; }
    body { background: #fff !important; }
    .invoice-box { box-shadow: none !important; border: 1px solid #ddd !important; }
}
</style>
@endsection

@section('content')

<!-- Page Title -->
<section class="page-title no-print" style="background-image:url({{ asset('hotel-assets/images/background/1.jpg') }})">
    <div class="auto-container">
        <h1>Booking Details</h1>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li><a href="{{ route('front.myBooking') }}">My Booking</a></li>
            <li>{{ $booking->booking_number }}</li>
        </ul>
    </div>
</section>

<section class="print-area" style="padding:60px 0; background:#f8f5f0;">
    <div class="auto-container">

        <!-- Action Bar -->
        <div class="no-print d-flex justify-content-between align-items-center flex-wrap mb-4" style="gap:10px;">
            <a href="{{ route('front.myBooking') }}" style="color:#555; text-decoration:none; font-size:14px;">
                <i class="fa fa-arrow-left mr-1"></i> Search Another Booking
            </a>
            <div style="display:flex; gap:10px;">
                <button onclick="window.print()" style="background:#1a1a2e; color:#fff; border:none; padding:10px 22px; border-radius:5px; font-size:14px; cursor:pointer;">
                    <i class="fa fa-print mr-1"></i> Print Invoice
                </button>
                <a href="{{ route('front.booking') }}" class="theme-btn btn-style-one" style="border:none; padding:10px 22px; font-size:14px;">
                    <span class="btn-wrap">
                        <span class="text-one">Book Again</span>
                        <span class="text-two">Book Again</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- Invoice Box -->
        <div class="invoice-box" style="background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,0.08); max-width:900px; margin:0 auto;">

            <!-- Invoice Header -->
            <div style="background:#1a1a2e; padding:30px 40px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                <div>
                    <div style="font-size:24px; font-weight:700; color:#c9a96e; letter-spacing:1px;">GRAND HOTEL</div>
                    <div style="color:#aaa; font-size:13px; margin-top:4px;">Booking Confirmation</div>
                    @isset($socialLink)
                        @if($socialLink->address)<div style="color:#888; font-size:12px; margin-top:2px;">{{ $socialLink->address }}</div>@endif
                        @if($socialLink->phone)<div style="color:#888; font-size:12px;">Tel: {{ $socialLink->phone }}</div>@endif
                    @endisset
                </div>
                <div style="text-align:right;">
                    <div style="font-size:22px; font-weight:700; color:#fff; letter-spacing:2px;">{{ $booking->booking_number }}</div>
                    <div style="margin-top:8px;">
                        @php
                        $statusColors = ['pending'=>'#f39c12','confirmed'=>'#27ae60','checked_in'=>'#2980b9','checked_out'=>'#8e44ad','cancelled'=>'#e74c3c'];
                        $statusColor  = $statusColors[$booking->status] ?? '#888';
                        @endphp
                        <span style="background:{{ $statusColor }}; color:#fff; padding:5px 15px; border-radius:20px; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:1px;">
                            {{ str_replace('_', ' ', $booking->status) }}
                        </span>
                    </div>
                    <div style="color:#888; font-size:12px; margin-top:6px;">Booked: {{ $booking->created_at->format('d M Y') }}</div>
                </div>
            </div>

            <div style="padding:35px 40px;">

                <!-- Guest & Room Info -->
                <div class="row mb-4">
                    <!-- Guest Info -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div style="background:#f8f5f0; padding:22px; border-radius:8px; height:100%;">
                            <h6 style="color:#c9a96e; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin-bottom:15px;">
                                <i class="fa fa-user mr-1"></i> Guest Information
                            </h6>
                            <div style="font-size:18px; font-weight:700; color:#1a1a2e; margin-bottom:6px;">{{ $booking->guest->name }}</div>
                            @if($booking->guest->phone)
                            <div style="color:#555; font-size:14px; margin-bottom:4px;">
                                <i class="fa fa-phone mr-1" style="color:#c9a96e;"></i> {{ $booking->guest->phone }}
                            </div>
                            @endif
                            @if($booking->guest->email)
                            <div style="color:#555; font-size:14px; margin-bottom:4px;">
                                <i class="fa fa-envelope mr-1" style="color:#c9a96e;"></i> {{ $booking->guest->email }}
                            </div>
                            @endif
                            @if($booking->guest->nationality)
                            <div style="color:#555; font-size:14px;">
                                <i class="fa fa-globe mr-1" style="color:#c9a96e;"></i> {{ $booking->guest->nationality }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Room Info -->
                    <div class="col-md-6">
                        <div style="background:#f8f5f0; padding:22px; border-radius:8px; height:100%;">
                            <h6 style="color:#c9a96e; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin-bottom:15px;">
                                <i class="fa fa-bed mr-1"></i> Room Information
                            </h6>
                            <div style="font-size:18px; font-weight:700; color:#1a1a2e; margin-bottom:6px;">
                                Room {{ $booking->room->room_number }}
                                @if($booking->room->floor) <small style="color:#888; font-size:13px; font-weight:400;">— Floor {{ $booking->room->floor }}</small>@endif
                            </div>
                            <div style="color:#c9a96e; font-size:14px; font-weight:600; margin-bottom:8px;">{{ $booking->room->roomType->name }}</div>
                            <div style="color:#555; font-size:13px;">
                                <span style="margin-right:12px;"><i class="fa fa-user mr-1"></i> {{ $booking->adults }} Adult(s)</span>
                                @if($booking->children)<span><i class="fa fa-child mr-1"></i> {{ $booking->children }} Child(ren)</span>@endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stay Dates -->
                <div style="background:#1a1a2e; padding:20px 25px; border-radius:8px; margin-bottom:25px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                    <div style="text-align:center; flex:1;">
                        <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;">Check In</div>
                        <div style="color:#fff; font-size:20px; font-weight:700;">{{ $booking->check_in->format('d') }}</div>
                        <div style="color:#c9a96e; font-size:13px;">{{ $booking->check_in->format('M Y') }}</div>
                        <div style="color:#888; font-size:11px; margin-top:2px;">{{ $booking->check_in->format('l') }}</div>
                    </div>
                    <div style="text-align:center; padding:0 20px;">
                        <div style="background:#c9a96e; color:#fff; padding:8px 18px; border-radius:20px; font-size:14px; font-weight:600; white-space:nowrap;">
                            {{ $booking->nights }} Night{{ $booking->nights > 1 ? 's' : '' }}
                        </div>
                        <div style="border-top:1px dashed rgba(201,169,110,0.4); margin-top:8px; padding-top:5px;">
                            <i class="fa fa-arrow-right" style="color:#c9a96e; font-size:18px;"></i>
                        </div>
                    </div>
                    <div style="text-align:center; flex:1;">
                        <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;">Check Out</div>
                        <div style="color:#fff; font-size:20px; font-weight:700;">{{ $booking->check_out->format('d') }}</div>
                        <div style="color:#c9a96e; font-size:13px;">{{ $booking->check_out->format('M Y') }}</div>
                        <div style="color:#888; font-size:11px; margin-top:2px;">{{ $booking->check_out->format('l') }}</div>
                    </div>
                </div>

                <!-- Special Requests -->
                @if($booking->special_requests)
                <div style="background:#fffbf0; border-left:4px solid #c9a96e; padding:15px 20px; border-radius:0 6px 6px 0; margin-bottom:25px;">
                    <div style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#c9a96e; margin-bottom:5px;">Special Requests</div>
                    <div style="color:#555; font-size:14px;">{{ $booking->special_requests }}</div>
                </div>
                @endif

                <!-- Billing Table -->
                <h6 style="color:#1a1a2e; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin-bottom:15px; border-bottom:2px solid #f0ebe2; padding-bottom:10px;">
                    <i class="fa fa-file-invoice mr-1" style="color:#c9a96e;"></i> Billing Summary
                </h6>

                <table style="width:100%; border-collapse:collapse; margin-bottom:20px; font-size:14px;">
                    <thead>
                        <tr style="background:#f8f5f0;">
                            <th style="padding:12px 15px; text-align:left; color:#555; font-weight:600;">Description</th>
                            <th style="padding:12px 15px; text-align:center; color:#555; font-weight:600;">Qty/Nights</th>
                            <th style="padding:12px 15px; text-align:right; color:#555; font-weight:600;">Rate</th>
                            <th style="padding:12px 15px; text-align:right; color:#555; font-weight:600;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Room Charge -->
                        <tr style="border-bottom:1px solid #f0ebe2;">
                            <td style="padding:14px 15px; color:#333;">
                                <strong>{{ $booking->room->roomType->name }}</strong>
                                <div style="color:#888; font-size:12px;">Room {{ $booking->room->room_number }}</div>
                            </td>
                            <td style="padding:14px 15px; text-align:center; color:#555;">{{ $booking->nights }} night{{ $booking->nights > 1 ? 's' : '' }}</td>
                            <td style="padding:14px 15px; text-align:right; color:#555;">₹{{ number_format($booking->room_rate, 2) }}</td>
                            <td style="padding:14px 15px; text-align:right; color:#333; font-weight:600;">₹{{ number_format($booking->room_total, 2) }}</td>
                        </tr>

                        <!-- Extra Services -->
                        @foreach($booking->bookingServices as $bs)
                        <tr style="border-bottom:1px solid #f0ebe2;">
                            <td style="padding:12px 15px; color:#333;">
                                {{ $bs->hotelService->name ?? 'Service' }}
                                <div style="color:#888; font-size:12px; text-transform:capitalize;">{{ $bs->hotelService->category ?? '' }}</div>
                            </td>
                            <td style="padding:12px 15px; text-align:center; color:#555;">{{ $bs->quantity }} {{ $bs->hotelService->unit ?? '' }}</td>
                            <td style="padding:12px 15px; text-align:right; color:#555;">₹{{ number_format($bs->unit_price, 2) }}</td>
                            <td style="padding:12px 15px; text-align:right; color:#333; font-weight:600;">₹{{ number_format($bs->total_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <!-- Subtotal -->
                        <tr style="border-top:1px solid #e0d9cf;">
                            <td colspan="3" style="padding:10px 15px; text-align:right; color:#555; font-size:13px;">Subtotal</td>
                            <td style="padding:10px 15px; text-align:right; color:#333;">₹{{ number_format($booking->room_total + $booking->services_total, 2) }}</td>
                        </tr>
                        <!-- Discount -->
                        @if($booking->discount > 0)
                        <tr>
                            <td colspan="3" style="padding:8px 15px; text-align:right; color:#27ae60; font-size:13px;">Discount</td>
                            <td style="padding:8px 15px; text-align:right; color:#27ae60;">- ₹{{ number_format($booking->discount, 2) }}</td>
                        </tr>
                        @endif
                        <!-- GST -->
                        <tr>
                            <td colspan="3" style="padding:8px 15px; text-align:right; color:#555; font-size:13px;">GST (12%)</td>
                            <td style="padding:8px 15px; text-align:right; color:#333;">₹{{ number_format($booking->tax, 2) }}</td>
                        </tr>
                        <!-- Grand Total -->
                        <tr style="background:#f8f5f0; border-top:2px solid #c9a96e;">
                            <td colspan="3" style="padding:14px 15px; text-align:right; font-weight:700; font-size:15px; color:#1a1a2e;">GRAND TOTAL</td>
                            <td style="padding:14px 15px; text-align:right; font-weight:700; font-size:18px; color:#c9a96e;">₹{{ number_format($booking->grand_total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Payment Status -->
                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div style="text-align:center; padding:18px; border-radius:8px; background:#f0f9f0; border:1px solid #c3e6cb;">
                            <div style="font-size:11px; color:#555; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;">Amount Paid</div>
                            <div style="font-size:22px; font-weight:700; color:#27ae60;">₹{{ number_format($booking->amount_paid, 2) }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div style="text-align:center; padding:18px; border-radius:8px; background:#fff3f0; border:1px solid #f5c6cb;">
                            <div style="font-size:11px; color:#555; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;">Amount Due</div>
                            <div style="font-size:22px; font-weight:700; color:{{ $booking->amount_due > 0 ? '#e74c3c' : '#27ae60' }};">₹{{ number_format($booking->amount_due, 2) }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="text-align:center; padding:18px; border-radius:8px; background:#f8f5f0; border:1px solid #e0d9cf;">
                            <div style="font-size:11px; color:#555; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;">Payment Status</div>
                            @php
                            $pColor = ['paid'=>'#27ae60','partial'=>'#f39c12','unpaid'=>'#e74c3c'];
                            @endphp
                            <span style="background:{{ $pColor[$booking->payment_status] ?? '#888' }}; color:#fff; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:600; text-transform:uppercase;">
                                {{ $booking->payment_status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Payment History -->
                @if($booking->payments->count() > 0)
                <div style="margin-top:15px;">
                    <h6 style="color:#1a1a2e; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px; border-bottom:2px solid #f0ebe2; padding-bottom:8px;">
                        <i class="fa fa-credit-card mr-1" style="color:#c9a96e;"></i> Payment History
                    </h6>
                    <table style="width:100%; border-collapse:collapse; font-size:13px;">
                        <thead>
                            <tr style="background:#f8f5f0;">
                                <th style="padding:9px 12px; text-align:left; color:#555;">Date</th>
                                <th style="padding:9px 12px; text-align:left; color:#555;">Method</th>
                                <th style="padding:9px 12px; text-align:right; color:#555;">Amount</th>
                                <th style="padding:9px 12px; text-align:center; color:#555;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->payments as $pay)
                            <tr style="border-bottom:1px solid #f0ebe2;">
                                <td style="padding:9px 12px; color:#555;">{{ $pay->paid_at ? \Carbon\Carbon::parse($pay->paid_at)->format('d M Y') : '—' }}</td>
                                <td style="padding:9px 12px; color:#555; text-transform:capitalize;">{{ str_replace('_',' ',$pay->method) }}</td>
                                <td style="padding:9px 12px; text-align:right; color:#333; font-weight:600;">₹{{ number_format($pay->amount, 2) }}</td>
                                <td style="padding:9px 12px; text-align:center;">
                                    <span style="background:{{ $pay->status === 'completed' ? '#27ae60' : '#f39c12' }}; color:#fff; padding:2px 10px; border-radius:10px; font-size:11px; text-transform:capitalize;">
                                        {{ $pay->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Footer Note -->
                <div style="margin-top:30px; padding-top:20px; border-top:1px solid #f0ebe2; text-align:center;">
                    <p style="color:#888; font-size:12px; margin-bottom:5px;">
                        Thank you for choosing Grand Hotel. We look forward to welcoming you.
                    </p>
                    <p style="color:#aaa; font-size:11px; margin:0;">
                        Check-in from 2:00 PM &nbsp;|&nbsp; Check-out by 11:00 AM &nbsp;|&nbsp; Valid ID required at check-in
                    </p>
                </div>

            </div>
        </div>
        <!-- End Invoice Box -->

        <!-- Help Card (no print) -->
        <div class="no-print" style="max-width:900px; margin:25px auto 0; background:#fff; padding:20px 30px; border-radius:8px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px; box-shadow:0 3px 15px rgba(0,0,0,0.05);">
            <div>
                <strong style="color:#1a1a2e; font-size:15px;">Need Help?</strong>
                <p style="color:#666; font-size:13px; margin:4px 0 0;">Contact our 24/7 front desk for any booking assistance.</p>
            </div>
            @isset($socialLink)
            <div style="display:flex; gap:15px; align-items:center; flex-wrap:wrap;">
                @if($socialLink->phone)
                <a href="tel:{{ $socialLink->phone }}" style="color:#c9a96e; font-weight:700; text-decoration:none; font-size:15px;">
                    <i class="fa fa-phone mr-1"></i> {{ $socialLink->phone }}
                </a>
                @endif
                @if($socialLink->gmail)
                <a href="mailto:{{ $socialLink->gmail }}" style="color:#555; text-decoration:none; font-size:13px;">
                    <i class="fa fa-envelope mr-1"></i> {{ $socialLink->gmail }}
                </a>
                @endif
            </div>
            @endisset
        </div>

    </div>
</section>

@endsection
