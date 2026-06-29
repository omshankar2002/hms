<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order - {{ $order->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            padding: 30px;
            border: 1px solid #ddd;
            width: 80%;
            margin: auto;
            position: relative;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-info {
            width: 50%;
        }
        .billed-from {
            width: 50%;
            text-align: right;
        }
        .invoice-title {
            text-align: center; 
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body onload="window.print()"> 
    <div class="invoice-box">
        <div class="header-section">
            <img src="{{ asset('front-assets/image/123.jpg') }}" alt="Company Logo" style="width: 150px;">
        </div>

        <h2 class="invoice-title">Order Invoice</h2>
        <div class="header-section">
            <div class="order-info">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->mobile }}</p>
            </div>

            <div class="billed-from">
                <h4>Billed From:</h4>
                <p><strong>Now, Voyager Counseling Hypnosis</strong></p>
                <p><strong>Email:</strong> dc@nowvoyagerhypnotherapy.com</p>
                <p><strong>Contact:</strong>602-301-6551</p>
            </div>
        </div>

        <h4>Order Items:</h4>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($orderItems) && count($orderItems) > 0)
              @foreach ($orderItems as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>${{ number_format($item->price,2) }}</td>                                        
                                            <td>{{ $item->qty }}</td>
                                            <td>${{ number_format($item->total,2) }}</td>
                                        </tr>   
                                    @endforeach
                @else
                <tr>
                    <td colspan="4">No items found in this order.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <h4 class="text-right">Grand Total: ${{ number_format($order->grand_total,2) }}</h4>
    </div>
</body>
</html>
