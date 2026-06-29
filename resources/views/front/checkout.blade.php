@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
            <h1 class="font-1 m-0">Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <section class="shop shop-checkout bg-white py-5 my-5" id="shop-checkout">

        <div class="container px-3 px-md-5">

            <div class="row">
                <div class="col-12">
                    <h2 class="cart-coupon" style="font-weight: bold; font-size: 2em;">Fill in Your Details Here</h2>
                </div>
            </div>
            <br>
            <br>

            <form class="checkoutForm mb-0" id="orderForm" name="orderForm" action="{{ route('front.processCheckout') }}" method="POST">
                @csrf
                <div class="row g-4">

                    <div class="col-12 col-lg-6">
                        <div class="bg-white shadow rounded-3 p-5 h-100">
                            <h5 class="fw-semibold mb-4">Shipping Address</h5>

                            <div class="row g-4">
                                @php
                                    $customerAddress = session('guest_address');
                                @endphp

                                <div class="col-md-12">
                                    <label>First Name <span class="required">*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="First Name"
                                        value="{{ !empty($customerAddress) ? $customerAddress['first_name'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Last Name"
                                        value="{{ !empty($customerAddress) ? $customerAddress['last_name'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email"
                                        value="{{ !empty($customerAddress) ? $customerAddress['email'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Country <span class="required">*</span></label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ !empty($customerAddress) && $customerAddress['country'] == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label>Address <span class="required">*</span></label>
                                    <textarea name="address" id="address" rows="3" placeholder="Address" class="form-control">{{ !empty($customerAddress) ? $customerAddress['address'] : '' }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Apartment</label>
                                    <input type="text" name="apartment" id="apartment" class="form-control"
                                        placeholder="Apartment, suite, unit, etc. (optional)"
                                        value="{{ !empty($customerAddress) ? $customerAddress['apartment'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>City <span class="required">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="City"
                                        value="{{ !empty($customerAddress) ? $customerAddress['city'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>State <span class="required">*</span></label>
                                    <input type="text" name="state" id="state" class="form-control"
                                        placeholder="State"
                                        value="{{ !empty($customerAddress) ? $customerAddress['state'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Zip <span class="required">*</span></label>
                                    <input type="text" name="zip" id="zip" class="form-control"
                                        placeholder="Zip"
                                        value="{{ !empty($customerAddress) ? $customerAddress['zip'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Mobile No. <span class="required">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                        placeholder="Mobile No."
                                        value="{{ !empty($customerAddress) ? $customerAddress['mobile'] : '' }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Order Notes (optional)</label>
                                    <textarea name="order_notes" id="order_notes" rows="2" placeholder="Order Notes (optional)"
                                        class="form-control">{{ !empty($customerAddress) ? $customerAddress['order_notes'] ?? '' : '' }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-lg-6">
                        <div class="order-summary-wrapper p-4 rounded-3 shadow-sm">

                            <div class="widget-title mt-4">
                                <h5>Order Summary</h5>
                            </div>
                            <br>
                            <br>

                            <!-- Order Items -->
                            <div class="card border-0 shadow-sm mb-4" style="background-color: #fff !important;">
                                <div class="card-body p-3">
                                    <div class="list-group list-group-flush">
                                        @foreach (Cart::content() as $item)
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                                <span class="text-dark fw-medium">{{ $item->name }} x
                                                    {{ $item->qty }}</span>
                                                <span class="text-dark fw-medium">${{ $item->price * $item->qty }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pricing Breakdown -->
                                    <div class="list-group list-group-flush border-top mt-3">
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                            <span class="text-body-secondary">Subtotal</span>
                                            <span class="text-dark fw-semibold">${{ Cart::subtotal() }}</span>
                                        </div>
                                        {{-- <div
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                            <span class="text-body-secondary">Discount</span>
                                            <span class="text-success fw-semibold" id="discount_value"><span
                                                    id="discount_value">
                                                    @if ($discount > 0)
                                                        -${{ number_format($discount, 2) }}
                                                    @else
                                                        $0.00
                                                    @endif
                                                </span></span>
                                        </div> --}}
                                        <!--<div-->
                                        <!--    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">-->
                                        <!--    <span class="text-body-secondary">Shipping</span>-->
                                        <!--    <span class="text-dark fw-semibold"-->
                                        <!--        id="shippingAmount">${{ number_format($totalShippingCharge, 2) }}</span>-->
                                        <!--</div>-->
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pt-3 pb-0">
                                            <span class="h5 fw-bold text-dark mb-0">Total</span>
                                            <span class="h5 fw-bold text-dark mb-0"
                                                id="grandTotal">${{ number_format($grandTotal, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Coupon Section -->
                            {{-- <div class="coupon-section mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control border-end-0"
                                        placeholder="Enter coupon code" name="discount_code" id="discount_code">
                                    <button class="btn btn--secondary btn-radius-right" type="button"
                                        id="apply-discount">
                                        Apply Coupon
                                    </button>
                                </div>

                                <div id="discount-response-wrapper" class="mt-2">
                                    @if (Session::has('code'))
                                        <div class="alert alert-success alert-dismissible py-2 fade show">
                                            <span class="badge bg-success me-2">{{ Session::get('code')->code }}</span>
                                            <button type="button" class="btn-close p-1" id="remove-discount"></button>
                                        </div>
                                    @endif
                                </div>
                            </div> --}}

                            <!-- Payment Section -->
                            <div class="payment-section py-4" style="background-color: #fff !important;">
                                <div class="card border-0 shadow-sm bg-white" style="background-color: #fff !important;">
                                    <div class="card-body p-4" style="background-color: #fff !important;">
                                        @if ($errors->has('payment'))
    <div class="alert alert-danger">
        {{ $errors->first('payment') }}
    </div>
@endif
    
    <br>

                                        <h5 class="fw-bold text-dark mb-4">Payment Method</h5>


                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method" value="square" id="payment_method_three" checked>
                                            <label class="form-check-label fw-medium text-dark" for="payment_method_three">
                                                Pay with Card
                                            </label>
                                        </div>


                                        <!-- Stripe Form -->
                                        {{-- <div class="card-payment-form mt-4 d-none" id="card-payment-form">
                                                <div class="mb-3">
                                                    <label for="card_number" class="mb-2">Card Number</label>
                                                    <input type="text" name="card_number" id="card_number"
                                                        placeholder="Valid Card Number" class="form-control">
                                                </div>

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="expiry_date" class="mb-2">Expiry Date</label>
                                                        <input type="text" name="expiry_date" id="expiry_date"
                                                            placeholder="MM/YYYY" class="form-control"
                                                            pattern="(0[1-9]|1[0-2])\/[0-9]{4}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="cvv" class="mb-2">CVV Code</label>
                                                        <input type="text" name="cvv" id="cvv"
                                                            placeholder="123" class="form-control">
                                                    </div>
                                                </div>
                                            </div> --}}

                                        <!-- ✅ ADD SQUARE HERE -->
                                     <div class="square-payment-form mt-4" id="square-payment-form">
    <div id="card-container"></div>
    <div id="payment-status-container" class="text-danger mt-2"></div>
</div>

                                    </div>
                          
                                    <button type="submit" class="btn text-white " style="background-color: #580069;">
                                        Pay Now
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </section>
@endsection

@section('customJs')

<script>
    document.addEventListener("DOMContentLoaded", async function () {
        // Initialize Square payment form
        try {
    //       console.log("App ID:", "{{ config('services.square.application_id') ?? 'empty' }}");
    // console.log("Environment:", "{{ config('services.square.environment') ?? 'empty' }}");
            const payments = Square.payments(
                "{{ config('services.square.application_id') }}", // Use your actual application ID
                "{{ config('services.square.environment') }}"    // Use your actual location ID
            );
            
            window.squareCard = await payments.card();
            await window.squareCard.attach('#card-container');
            
            console.log('Square card initialized successfully');
        } catch (error) {
            console.error('Square initialization error:', error);
            document.getElementById('payment-status-container').innerText = 
                "Failed to load payment form. Please refresh the page.";
        }
    });

    // Handle form submission
    document.getElementById('orderForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // 🛑 keep this only for now
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.innerText = 'Processing...';

    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    if (paymentMethod === 'square') {
        try {
            const result = await window.squareCard.tokenize();
            console.log(result);

            if (result.status === 'OK') {
                const nonceInput = document.createElement('input');
                nonceInput.type = 'hidden';
                nonceInput.name = 'square_nonce';
                nonceInput.value = result.token;
                this.appendChild(nonceInput);

                // ✅ Use native form submission to ensure all fields are sent
                this.submit();
            } else {
                let errorMessage = 'Payment processing failed';
                if (result.errors && result.errors.length > 0) {
                    errorMessage = result.errors[0].message;
                }
                document.getElementById('payment-status-container').innerText = errorMessage;
                submitButton.disabled = false;
                submitButton.innerText = 'Pay Now';
            }
        } catch (error) {
            console.error('Tokenization error:', error);
            document.getElementById('payment-status-container').innerText =
                'Error processing payment. Please try again.';
            submitButton.disabled = false;
            submitButton.innerText = 'Pay Now';
        }
    } else {
        // If other methods are added, allow default submission
        this.submit();
    }
});

</script>
@endsection
