@extends('front.layouts.app')

@section('content')

{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">{{ $product->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
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
            <h1 class="font-1 m-0">{{ $product->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <section class="section" id="shop">
        <div class="r-container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="product-img">
                        @if ($product->product_images)
                            @foreach ($product->product_images as $key => $productImage)
                                <div class="product-img">
                                    <img class="img-fluid"
                                        src="{{ asset('uploads/product/large/' . $productImage->image) }}"
                                        alt="product image" />
                                    <a class="img-popup" href="assets/images/shop/full/1.jpg" alt="product image"></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="product-content">
                        <div class="product-title">
                            <h3>{{ $product->title }}</h3>
                        </div>

                        @if ($product->compare_price > 0)
                            <div class="product-price"><span>${{ $product->price }}</span></div>
                        @endif



                        <div class="product-desc">
                            <p>{!! $product->short_description !!}</p>
                        </div>
                        
                          @if($product->category->slug == 'pain-relief')
                                <div class="my-2">
                                    <p>Listen to a preview here:</p>
                                    <audio controls>
                                        <source src="{{ asset('front-assets/audios/Pain-Sample.mp3') }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @elseif($product->category->slug == 'ocean-anti-stress-relief')
                                <div class="my-2">
                                    <p>Listen to a preview here:</p>
                                    <audio controls>
                                        <source src="{{ asset('front-assets/audios/Stress-Sample.mp3') }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @elseif($product->category->slug == 'forest-anti-stress-relief')
                                <div class="my-2">
                                    <p>Listen to a preview here:</p>
                                    <audio controls>
                                        <source src="{{ asset('front-assets/audios/NV_Sleep_Forest_5m37s_to_6m07s.wav') }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif


                        <div class="product-action">
                            <div class="product-quantity d-flex justify-content-left align-items-left gap-2">
                                <a class="btn btn-sm text-white sub minus" href="javascript:void(0)"
                                    data-id="{{ $product->id }}" style="background-color: #580069;">
                                    <i class="fa fa-minus"></i>
                                </a>
                                <input class="form-control text-center pro-qunt" type="text" value="1" readonly
                                    data-id="{{ $product->id }}" data-max="10" data-min="1" data-step="1"
                                    style="width: 50px;" />
                                <a class="btn btn-sm text-white add plus" href="javascript:void(0)"
                                    data-id="{{ $product->id }}" style="background-color: #580069;">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            @if ($product->is_custom_price)
                                <div class="mb-4 mt-4">
                                    <label for="customPriceInput" class="form-label fw-semibold">Price ($)</label>
                                    <input type="number" id="customPriceInput" class="form-control custom-price-input"
                                        placeholder="Enter your price" min="1" style="border: 2px solid #343a40;" />
                                </div>
                            @endif


                            <div class="mt-4 mb-4">
                                @if ($product->track_qty == 'Yes' && $product->qty == 0)
                                    <span class="text-danger fw-semibold small">Out of Stock</span>
                                @else
                                    <a href="javascript:void(0);" onclick="addToCart({{ $product->id }}, this)"
                                        class="btn btn-sm btn-outline-primary w-auto d-block mx-auto">
                                        <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="product-details">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="name">Category:</td>
                                        <td class="value">{{ $product->category->name ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


    @if (!empty($relatedProducts))
        <section class="shop shop-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5>Related Products</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach ($relatedProducts as $relProduct)
                        @php
                            $productImage = $relProduct->product_images->first();
                        @endphp
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="product-item">
                                <div class="product-img">
                                    <a href="{{ route('front.product', $relProduct->slug) }}" class="product-img">
                                        @if (!empty($productImage->image))
                                            <img src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                alt="Product" />
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" />
                                        @endif
                                    </a>

                                    @if (!empty($productImage->image))
                                        @if ($relProduct->track_qty == 'Yes')
                                            @if ($relProduct->qty > 0)
                                                <a class="add-to-cart" href="javascript:void(0);"
                                                    onclick="addToCart({{ $relProduct->id }});">
                                                    <i class="fas fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @else
                                                <a class="add-to-cart" href="javascript:void(0);"
                                                    style="pointer-events: none; opacity: 0.5;">
                                                    Out Of Stock
                                                </a>
                                            @endif
                                        @else
                                            <a class="add-to-cart" href="javascript:void(0);"
                                                onclick="addToCart({{ $relProduct->id }});">
                                                <i class="fas fa-shopping-cart"></i> Add To Cart
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="product-content">
                                    <div class="product-title">
                                        <a
                                            href="{{ route('front.product', $relProduct->slug) }}">{{ $relProduct->title }}</a>
                                    </div>
                                    <div class="product-price"><span>₹{{ $relProduct->price }}</span></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection


@section('customJs')
    <script>
        $(document).ready(function() {
            $('.product-quantity .plus').click(function() {
                let input = $(this).closest('.product-quantity').find('.pro-qunt');
                let max = parseInt(input.data('max')) || 99;
                let val = parseInt(input.val()) || 1;
                if (val < max) input.val(val + 1);
            });

            $('.product-quantity .minus').click(function() {
                let input = $(this).closest('.product-quantity').find('.pro-qunt');
                let min = parseInt(input.data('min')) || 1;
                let val = parseInt(input.val()) || 1;
                if (val > min) input.val(val - 1);
            });
        });
    </script>

    <script>
        function addToCart(productId, btn) {
            let price = null;
            const customInput = $(btn).closest('.col-lg-6').find('.custom-price-input');
            if (customInput.length > 0) {
                price = parseFloat(customInput.val());
                if (isNaN(price) || price <= 0) {
                    alert('Please enter a valid price.');
                    return;
                }
            }

            $.ajax({
                url: "{{ route('front.addToCart') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    custom_price: price
                },
                success: function(response) {
                    if (response.status) {
                        window.location.href = "{{ route('front.cart') }}";
                    } else {
                        alert(response.message || "Something went wrong");
                    }
                }
            });
        }
    </script>
@endsection
