@extends('front.layouts.app')

@section('content')
{{-- Desktop Background --}}
<div class="section position-relative desktop-hero"
     style="background-image: url({{ asset('front-assets/image/breadcrumb.webp') }}); height: 70vh; background-position: top; background-size: cover;">
    <div class="image-overlay"></div>
    <div class="r-container h-100 position-relative" style="z-index: 2;">
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
             style="max-width: 895px;">
            <h1 class="font-1 m-0">Products</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
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
            <h1 class="font-1 m-0">Products</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


    <section class="section" id="shop">
        <div class="r-container">
            <!-- Heading & Sorting -->
            <div class="d-flex flex-column gap-2 mb-4" style="max-width: 100%;">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="font-1 fw-semibold mb-0">All Products</h3>
                    <form method="GET">
                        @foreach (request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" id="sort" class="form-control" onchange="this.form.submit()"
                            style="min-width: 180px; appearance: auto;">
                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Price High to Low
                            </option>
                            <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Price Low to High
                            </option>
                            <option value="a_to_z" {{ $sort == 'a_to_z' ? 'selected' : '' }}>A to Z</option>
                            <option value="z_to_a" {{ $sort == 'z_to_a' ? 'selected' : '' }}>Z to A</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mb-4 animate__animated animate__slideInUp">
                @foreach ($products as $product)
                    @php
                        $productImage = $product->product_images->first();
                    @endphp
                    <div class="col">
                        <div class="border rounded-3 overflow-hidden h-100 d-flex flex-column">
                                @if (!empty($productImage->image))
                                    <a href="{{ route('front.product', $product->slug) }}" class="d-block">
                                        <img src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                            alt="{{ $product->title }}" class="img-fluid w-100"
                                            style="height: 290px; object-fit: cover;">
                                    </a>
                                @else
                                    <a href="{{ route('front.product', $product->slug) }}" class="d-block">
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default Image"
                                            class="img-fluid w-100" style="height: 290px; object-fit: cover;">
                                    </a>
                                @endif

                            <div class="py-3 px-3 d-flex flex-column gap-2 flex-grow-1 justify-content-between">
                                <a href="{{ route('front.product', $product->slug) }}"
                                    class="text-black font-1 fw-semibold small text-decoration-none d-block text-center">
                                    {{ Str::limit($product->title, 50, '...') }}
                                </a>


                                <div class="product-price small text-center">
                                    @if ($product->is_custom_price)
                                        <span class="fw-bold text-black">From: $0.00</span>
                                    @else
                                        <span class="fw-bold">${{ $product->price }}</span>
                                        @if ($product->compare_price > 0)
                                            <span class="text-muted ms-2"><del>${{ $product->compare_price }}</del></span>
                                        @endif
                                    @endif
                                </div>

                                <div>
                                    @if ($product->track_qty == 'Yes' && $product->qty == 0)
                                        <span class="text-danger fw-semibold small">Out of Stock</span>
                                    @else
                                        @if ($product->is_custom_price)
                                            <a href="{{ route('front.product', $product->slug) }}"
                                                class="btn btn-sm btn-outline-primary w-auto d-block mx-auto">
                                                <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" onclick="addToCart({{ $product->id }});"
                                                class="btn btn-sm btn-outline-primary w-auto d-block mx-auto">
                                                <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                            </a>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12 text-start">
                    @if ($products->lastPage() > 1)
                        <ul class="pagination">
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>



@endsection

@section('customJs')
    <script>
        // Initialize price range slider
        var slider = $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000,
            from: {{ $priceMin }},
            to: {{ $priceMax }},
            step: 10,
            prefix: "$",
            skin: "round",
            onFinish: function(data) {
                applyFilters();
            }
        }).data("ionRangeSlider");

        // Event listeners
        $(".brand-label, #sort").change(function() {
            applyFilters();
        });

        function applyFilters() {
            let url = '{{ url()->current() }}?';
            const params = new URLSearchParams(window.location.search);

            // Brand filter
            const brands = [];
            $(".brand-label:checked").each(function() {
                brands.push($(this).val());
            });
            if (brands.length) params.set('brand', brands.join(','));

            // Price filter
            params.set('price_min', slider.result.from);
            params.set('price_max', slider.result.to);

            // Sort filter
            params.set('sort', $("#sort").val());

            window.location.href = url + params.toString();
        }
    </script>
@endsection
