<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $booking->booking_number }}</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 14px; color: #333; background: #f8f9fa; }
        .invoice-wrapper { max-width: 800px; margin: 30px auto; background: white; padding: 40px; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 8px; }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; border-bottom: 3px solid #1a1a2e; padding-bottom: 20px; }
        .hotel-name { font-size: 24px; font-weight: bold; color: #1a1a2e; }
        .invoice-title { font-size: 28px; font-weight: bold; color: #c9a96e; text-align: right; }
        .invoice-number { font-size: 14px; color: #666; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px; }
        .info-box { background: #f8f9fa; padding: 15px; border-radius: 6px; border-left: 4px solid #c9a96e; }
        .info-box h4 { font-size: 12px; text-transform: uppercase; color: #666; margin-bottom: 8px; letter-spacing: 1px; }
        .info-box p { margin: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        thead { background: #1a1a2e; color: white; }
        thead th { padding: 10px 12px; text-align: left; font-size: 13px; }
        tbody td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        tbody tr:last-child td { border-bottom: none; }
        .totals-table { width: 50%; margin-left: auto; }
        .totals-table td { padding: 6px 12px; }
        .total-row { background: #1a1a2e; color: white; font-weight: bold; }
        .due-row { background: #e74c3c; color: white; font-weight: bold; }
        .badge { padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-success { background: #27ae60; color: white; }
        .badge-warning { background: #f39c12; color: white; }
        .badge-danger { background: #e74c3c; color: white; }
        .print-btn { position: fixed; top: 20px; right: 20px; background: #1a1a2e; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 14px; }
        @media print {
            body { background: white; }
            .print-btn { display: none; }
            .invoice-wrapper { box-shadow: none; margin: 0; }
        }
        .footer-note { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666; font-size: 12px; }
    </style>
</head>
<body>
<button class="print-btn" onclick="window.print()"><i class="fas fa-print mr-1"></i> Print Invoice</button>

<div class="invoice-wrapper">
    <div class="invoice-header">
        <div>
            <div class="hotel-name">🏨 Grand Hotel</div>
            <p style="color:#666; margin-top:5px;">Luxury Hospitality Services</p>
        </div>
        <div style="text-align:right;">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-number">{{ $booking->booking_number }}</div>
            <div class="invoice-number">Date: {{ now()->format('d M Y') }}</div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h4>Bill To (Guest)</h4>
            <p><strong>{{ $booking->guest->name }}</strong></p>
            <p>📱 {{ $booking->guest->phone }}</p>
            @if($booking->guest->email)<p>✉️ {{ $booking->guest->email }}</p>@endif
            @if($booking->guest->nationality)<p>🌍 {{ $booking->guest->nationality }}</p>@endif
            @if($booking->guest->id_number)<p>🪪 {{ $booking->guest->id_type }}: {{ $booking->guest->id_number }}</p>@endif
        </div>
        <div class="info-box">
            <h4>Booking Details</h4>
            <p><strong>Room:</strong> {{ $booking->room->room_number }} — {{ $booking->room->roomType->name }}</p>
            <p><strong>Check In:</strong> {{ $booking->check_in->format('d M Y') }}</p>
            <p><strong>Check Out:</strong> {{ $booking->check_out->format('d M Y') }}</p>
            <p><strong>Nights:</strong> {{ $booking->nights }}</p>
            <p><strong>Guests:</strong> {{ $booking->adults }} Adults, {{ $booking->children }} Children</p>
            <p><strong>Status:</strong>
                @php $colors = ['pending'=>'warning','confirmed'=>'warning','checked_in'=>'success','checked_out'=>'success','cancelled'=>'danger']; @endphp
                <span class="badge badge-{{ $colors[$booking->status] ?? 'warning' }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
            </p>
        </div>
    </div>

    {{-- Room Charge --}}
    <h4 style="margin-bottom:10px; color:#1a1a2e;">Room Charges</h4>
    <table>
        <thead>
            <tr><th>Description</th><th>Rate</th><th>Nights</th><th>Amount</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->room->roomType->name }} — Room {{ $booking->room->room_number }}</td>
                <td>₹{{ number_format($booking->room_rate, 2) }}/night</td>
                <td>{{ $booking->nights }}</td>
                <td>₹{{ number_format($booking->room_total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Services --}}
    @if($booking->bookingServices->count() > 0)
    <h4 style="margin-bottom:10px; color:#1a1a2e;">Additional Services</h4>
    <table>
        <thead>
            <tr><th>Service</th><th>Category</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($booking->bookingServices as $bs)
            <tr>
                <td>{{ $bs->hotelService->name }}</td>
                <td>{{ ucfirst($bs->hotelService->category) }}</td>
                <td>{{ $bs->quantity }}</td>
                <td>₹{{ number_format($bs->unit_price, 2) }}</td>
                <td>₹{{ number_format($bs->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- Totals --}}
    <table class="totals-table">
        <tbody>
            <tr><td>Room Total</td><td style="text-align:right;">₹{{ number_format($booking->room_total, 2) }}</td></tr>
            <tr><td>Services Total</td><td style="text-align:right;">₹{{ number_format($booking->services_total, 2) }}</td></tr>
            @if($booking->discount > 0)
            <tr><td style="color:#e74c3c;">Discount</td><td style="text-align:right; color:#e74c3c;">-₹{{ number_format($booking->discount, 2) }}</td></tr>
            @endif
            <tr><td>GST (12%)</td><td style="text-align:right;">₹{{ number_format($booking->tax, 2) }}</td></tr>
            <tr class="total-row"><td>Grand Total</td><td style="text-align:right;">₹{{ number_format($booking->grand_total, 2) }}</td></tr>
            <tr><td style="color:#27ae60;">Amount Paid</td><td style="text-align:right; color:#27ae60;">₹{{ number_format($booking->amount_paid, 2) }}</td></tr>
            @if($booking->amount_due > 0)
            <tr class="due-row"><td>Amount Due</td><td style="text-align:right;">₹{{ number_format($booking->amount_due, 2) }}</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Payments --}}
    @if($booking->payments->count() > 0)
    <h4 style="margin:20px 0 10px; color:#1a1a2e;">Payment History</h4>
    <table>
        <thead>
            <tr><th>Date</th><th>Method</th><th>Transaction ID</th><th>Amount</th></tr>
        </thead>
        <tbody>
            @foreach($booking->payments as $pay)
            <tr>
                <td>{{ $pay->paid_at ? $pay->paid_at->format('d M Y H:i') : '—' }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $pay->method)) }}</td>
                <td>{{ $pay->transaction_id ?? '—' }}</td>
                <td>₹{{ number_format($pay->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer-note">
        <p>Thank you for choosing Grand Hotel. We hope you enjoyed your stay!</p>
        <p style="margin-top:5px;">For any queries, contact us at hotel@example.com</p>
    </div>
</div>
</body>
</html>
