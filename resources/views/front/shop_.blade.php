@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{ asset('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
        <div class="hero-content">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <h2 class="hero-title">Products</h2>
                </div>
            </div>
        </div>
        <!-- End .hero-content-->
    </div>
    <!-- End .container-->
    <div class="breadcrumb-holder">
        <div class="container">
            <ol class="breadcrumb d-flex justify-content-center justify-content-lg-start breadcrumb-light">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
            </ol>
            <!-- End .breadcrumb-->
        </div>
        <!-- End .container-->
    </div>
    <!-- End .breadcrumb-holder-->
    <div class="divider">
        <div class="bg"></div><a class="scroll-btn" href="#about-2">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px"
                height="21px">
                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                    d="M11.627,15.787 L6.591,19.792 C6.223,20.084 5.700,20.084 5.333,19.792 L0.297,15.787 C0.152,15.670 0.061,15.522 -0.000,15.362 L-0.000,14.626 C0.036,14.540 0.076,14.452 0.139,14.374 C0.487,13.944 1.121,13.873 1.555,14.217 L5.000,16.959 L5.000,0.021 L7.006,0.021 L7.006,16.862 L7.049,16.859 L10.370,14.217 C10.804,13.873 11.438,13.944 11.785,14.374 C12.132,14.809 12.061,15.440 11.627,15.787 Z">
                </path>
            </svg></a>
    </div>
    <!-- End .divider-->
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
                <div class="sub-title">
                    <h2>Categories</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">                            
                            @if($categories->isNotEmpty())
                            @foreach ($categories as $key => $category)                               
                            <div class="accordion-item">
                                @if($category->sub_category->isNotEmpty())
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                @else
                                <a href="{{ route("front.shop",$category->slug) }}" class="nav-item nav-link {{ ($categorySelected == $category->id) ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                @endif
                                
                                @if($category->sub_category->isNotEmpty())
                                <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ ($categorySelected == $category->id) ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <div class="navbar-nav">
                                            @foreach ($category->sub_category as $subCategory)
                                            <a href="{{ route("front.shop",[$category->slug,$subCategory->slug]) }}" class="nav-item nav-link {{ ($subCategorySelected == $subCategory->id) ? 'text-primary' : '' }}">{{ $subCategory->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div> 
                            @endforeach 
                            @endif                                         
                                                
                        </div>
                    </div>
                </div>

                <div class="sub-title mt-5">
                    <h2>Brand</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        @if ($brands->isNotEmpty())
                        @foreach ($brands as $brand)
                        <div class="form-check mb-2">
                            <input {{ (in_array($brand->id, $brandsArray)) ? 'checked' : ''  }} class="form-check-input brand-label" type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                {{ $brand->name }}
                            </label>
                        </div>
                        @endforeach                        
                        @endif
                    </div>
                </div>

                <div class="sub-title mt-5">
                    <h2>Price</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <input type="text" class="js-range-slider" name="my_range" value="" />
               
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <div class="ml-2">
                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest" {{ ($sort == 'latest') ? 'selected' : '' }}>Latest</option>
                                    <option value="price_desc" {{ ($sort == 'price_desc') ? 'selected' : '' }}>Price High</option>
                                    <option value="price_asc" {{ ($sort == 'price_asc') ? 'selected' : '' }}>Price Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                     
                    
                    @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    @php
                        $productImage = $product->product_images->first();
                    @endphp
                    <div class="col-md-4">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                
                                <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                                @if (!empty($productImage->image))
                                    <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" /> 
                                @else
                                    <img class="card-img-top"  src="{{ asset('admin-assets/img/default-150x150.png') }}"  />
                                @endif
                                </a>
                                
                                <a onclick="addToWishList({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>                            
                  

                                <div class="product-action">                            
                                    @if($product->track_qty == 'Yes')
                                        @if ($product->qty > 0)
                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>  
                                        @else
                                        <a class="btn btn-dark" href="javascript:void(0);">
                                            Out Of Stock
                                        </a>
                                        @endif                                                     
                                    @else
                                    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a> 
                                    @endif
                                </div>
                                
                            </div>                        
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route("front.product",$product->slug) }}">{{ $product->title }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>${{ $product->price }}</strong></span>

                                    @if($product->compare_price > 0)
                                    <span class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                    @endif

                                </div>
                            </div>                        
                        </div>                                               
                    </div>  

                    @endforeach
                    @endif
                    

                    <div class="col-md-12 pt-5">
                        {{ $products->withQueryString()->links() }}                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>

    rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: {{ ($priceMin) }},
        step: 10,
        to: {{ ($priceMax) }},
        skin: "round",
        max_postfix: "+",
        prefix: "$",
        onFinish: function() {
            apply_filters()
        }
    });

    // Saving it's instance to var
    var slider = $(".js-range-slider").data("ionRangeSlider");

    $(".brand-label").change(function(){
        apply_filters();
    });

    $("#sort").change(function(){
        apply_filters();
    });

    function apply_filters(){
        var brands = [];

        $(".brand-label").each(function(){
            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }
        });


        var url = '{{ url()->current() }}?';

        // Brand Filter
        if (brands.length > 0) {
            url += '&brand='+brands.toString()
        }

        // Price Range filter
        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;

        // Sorting filter

        var keyword = $("#search").val();

        if (keyword.length > 0) {
            url += '&search='+keyword;
        }

        url += '&sort='+$("#sort").val() 

        window.location.href = url;


    }
</script>
@endsection