@extends('front.layouts.app')

@section('content')
    <section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
        <div class="bg-section"> <img src="{{ asset('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
        <div class="container">
            <div class="hero-content">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <h2 class="hero-title">Cart</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-holder">
            <div class="container">
                <ol class="breadcrumb d-flex justify-content-center justify-content-lg-start breadcrumb-light">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.html">Shop</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Cart</a></li>
                </ol>
            </div>
        </div>
        <div class="divider">
            <div class="bg"></div>
            <a class="scroll-btn" href="#shop">
                <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="21px">
                    <path fill="#fff"
                        d="M11.627,15.787 L6.591,19.792 C6.223,20.084 5.700,20.084 5.333,19.792 L0.297,15.787 C0.152,15.670 0.061,15.522 -0.000,15.362 L-0.000,14.626 C0.036,14.540 0.076,14.452 0.139,14.374 C0.487,13.944 1.121,13.873 1.555,14.217 L5.000,16.959 L5.000,0.021 L7.006,0.021 L7.006,16.862 L7.049,16.859 L10.370,14.217 C10.804,13.873 11.438,13.944 11.785,14.374 C12.132,14.809 12.061,15.440 11.627,15.787 Z" />
                </svg>
            </a>
        </div>
    </section>


    <section class="shop shop-cart bg-white" id="shopcart">
        <div class="container">
            <div class="row">
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
                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="cart-product">
                                        <th class="cart-product-item">Product</th>
                                        <th class="cart-product-price">Price</th>
                                        <th class="cart-product-quantity">Quantity</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cartContent as $item)
                                        <tr class="cart-product">
                                            <td class="cart-product-item">
                                                <div class="cart-product-remove">
                                                    @if (!empty($item->options->productImage->image))
                                                        <img src="assets/images/shop/cross.png" alt="icon" />
                                                </div>
                                                <div class="cart-product-img"><img src="assets/images/shop/thumb/1.jpg"
                                                        alt="product" /></div>
                                                <div class="cart-product-name">
                                                    <h6>natural cacao powder</h6>
                                                </div>
                                            </td>
                                            <td class="cart-product-price">$ 10.00</td>
                                            <td class="cart-product-quantity">
                                                <div class="product-quantity">
                                                    <input class="pro-qunt" type="text" value="2" readonly=""
                                                        data-max="10" data-min="1" data-step="1" /><span><a
                                                            class="minus" href="javascript:void(0)"><i
                                                                class="fa fa-minus"></i></a><a class="plus"
                                                            href="javascript:void(0)"><i class="fa fa-plus"></i></a></span>
                                                </div>
                                            </td>
                                            <td class="cart-product-total">$ 10.00</td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="cart-product-action">
                            <form class="form-inline">
                                <input class="form-control" id="coupon" type="text" placeholder="Coupon Code" />
                                <button class="btn btn--secondary btn-radius-right" type="submit">Apply Coupon</button>
                            </form>
                            <div><a class="btn btn--secondary btn-radius-right" href="our-products.php">update cart</a><a
                                    class="btn btn--secondary btn-radius-right" href="checkout.php">Checkout</a></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="cart-total-amount">
                            <h5>Cart Totals :</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="head">Subtotal</td>
                                        <td>$140</td>
                                    </tr>
                                    <tr>
                                        <td class="head">total</td>
                                        <td class="amount">$140</td>
                                    </tr>
                                </tbody>
                            </table><a class="btn btn--secondary btn-radius-right" href="#">procced to checkout</a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $('.add').click(function() {
            var qtyElement = $(this).parent().prev();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                qtyElement.val(qtyValue + 1);

                var rowId = $(this).data('id');
                var newQty = qtyElement.val();
                updateCart(rowId, newQty)
            }
        });

        $('.sub').click(function() {
            var qtyElement = $(this).parent().next();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                qtyElement.val(qtyValue - 1);

                var rowId = $(this).data('id');
                var newQty = qtyElement.val();
                updateCart(rowId, newQty)
            }
        });

        function updateCart(rowId, qty) {
            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'post',
                data: {
                    rowId: rowId,
                    qty: qty
                },
                dataType: 'json',
                success: function(response) {
                    window.location.href = '{{ route('front.cart') }}';
                }
            });
        }

        function deleteItem(rowId) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route('front.deleteItem.cart') }}',
                    type: 'post',
                    data: {
                        rowId: rowId
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '{{ route('front.cart') }}';
                    }
                });
            }
        }
    </script>
@endsection
