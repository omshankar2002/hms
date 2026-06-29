@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
            <h1 class="font-1 m-0">Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <section class="shop shop-cart bg-white py-5 my-4" id="shopcart">

        <div class="container">
            <div class="row">
                {{-- Success / Error messages --}}
                @if (Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! Session::get('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (Cart::count() > 0)
                    <div class="col-12">
                        <h4 class="mb-4">Your Shopping Cart</h4>

                        <div class="table-responsive">
                            <table class="table align-middle" style="background-color: #fff;">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 10%;">S. No.</th>
                                        <th style="width: 30%;">Product</th>
                                        <th style="width: 25%;">Quantity</th>
                                        <th style="width: 15%;">Total</th>
                                        <th style="width: 10%;">Remove</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($cartContent as $item)
                                        <tr>
                                            {{-- S. No. --}}
                                            <td class="text-center fw-semibold">{{ $i++ }}</td>

                                            {{-- Product Name + Image --}}
                                            <td>
                                                <div class="d-flex justify-content-left align-items-left gap-2">
                                                    @if (!empty($item->options->productImage->image))
                                                        <img src="{{ asset('uploads/product/small/' . $item->options->productImage->image) }}"
                                                            alt="Product" class="img-fluid rounded" style="width: 50px;">
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}"
                                                            alt="Default" class="img-fluid rounded" style="width: 50px;">
                                                    @endif
                                                    <span class="fw-medium">{{ $item->name }}</span>
                                                </div>
                                            </td>


                                            {{-- Quantity --}}
                                            <td class="text-center">
                                            <div class="product-quantity d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                                                <button class="btn btn-sm text-white add" style="background-color: #580069; width: 36px; height: 36px;"
                                                    data-id="{{ $item->rowId }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            
                                                <input type="text" class="form-control text-center pro-qunt"
                                                    value="{{ $item->qty }}" readonly data-id="{{ $item->rowId }}"
                                                    style="width: 50px; height: 36px;" />
                                            
                                                <button class="btn btn-sm text-white sub" style="background-color: #580069; width: 36px; height: 36px;"
                                                    data-id="{{ $item->rowId }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>

                                            </td>


                                            {{-- Total --}}
                                            <td class="text-center">
                                                @php
                                                    $price = $item->options->custom_price ?? $item->price;
                                                @endphp
                                                <strong>${{ $price * $item->qty }}</strong>
                                            </td>

                                            {{-- Remove --}}
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="deleteItem('{{ $item->rowId }}')"
                                                    class="btn btn-sm text-white" style="background-color: #580069;">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- Cart actions --}}
                        <div class="d-flex justify-content-between flex-wrap gap-2 mt-4">
                            <a class="btn text-white" style="background-color: #580069;"
                                href="{{ route('front.products') }}">Continue Shopping</a>
                            <a class="btn text-white" style="background-color: #580069;"
                                href="{{ route('front.checkout') }}">Proceed to Checkout</a>
                        </div>

                        {{-- Cart Total --}}
                        <div class="row justify-content-end mt-5">
                            <div class="col-md-8"> {{-- You can change 5 to 4 or 6 as per your design --}}
                                <div class="card" style="background-color: #ffffff; border: 1px solid #eee;">
                                    <div class="card-body">
                                        <h5 class="card-title text-dark">Cart Totals</h5>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                style="background-color: #ffffff; border: none; color: #000;">
                                                <span>Subtotal:</span>
                                                <strong>${{ Cart::subtotal() }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                style="background-color: #ffffff; border: none; color: #000;">
                                                <span>Total:</span>
                                                <strong>${{ Cart::subtotal() }}</strong>
                                            </li>
                                        </ul>

                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="{{ route('front.checkout') }}" class="btn btn-sm text-white"
                                                style="background-color: #580069;">
                                                Checkout Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @else
                    {{-- Cart empty --}}
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            <h5>Your cart is empty!</h5>
                            <a href="{{ route('front.products') }}" class="btn btn-primary mt-2">Go to Shop</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@section('customJs')
    <script>
        // Quantity Update
        $('.add').click(function() {
            var rowId = $(this).data('id');
            var qtyElement = $(this).closest('.product-quantity').find('.pro-qunt');
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                qtyElement.val(qtyValue + 1);
                updateCart(rowId, qtyElement.val());
            }
        });

        $('.sub').click(function() {
            var rowId = $(this).data('id');
            var qtyElement = $(this).closest('.product-quantity').find('.pro-qunt');
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                qtyElement.val(qtyValue - 1);
                updateCart(rowId, qtyElement.val());
            }
        });

        function updateCart(rowId, qty) {
            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'post',
                data: {
                    rowId: rowId,
                    qty: qty,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload(); // प्राइस अपडेट के लिए रीलोड
                }
            });
        }

        function deleteItem(rowId) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route('front.deleteItem.cart') }}',
                    type: 'post',
                    data: {
                        rowId: rowId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.reload(); // आइटम हटाने के बाद रीलोड
                    }
                });
            }
        }
    </script>
@endsection
