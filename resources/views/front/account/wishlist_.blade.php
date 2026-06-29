@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Wishlist</h2>
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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Wishlist</a></li>
        </ol>
        <!-- End .breadcrumb-->
      </div>
      <!-- End .container-->
    </div>
    <!-- End .breadcrumb-holder-->
    <div class="divider">
      <div class="bg"></div><a class="scroll-btn" href="#about-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="21px">
          <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M11.627,15.787 L6.591,19.792 C6.223,20.084 5.700,20.084 5.333,19.792 L0.297,15.787 C0.152,15.670 0.061,15.522 -0.000,15.362 L-0.000,14.626 C0.036,14.540 0.076,14.452 0.139,14.374 C0.487,13.944 1.121,13.873 1.555,14.217 L5.000,16.959 L5.000,0.021 L7.006,0.021 L7.006,16.862 L7.049,16.859 L10.370,14.217 C10.804,13.873 11.438,13.944 11.785,14.374 C12.132,14.809 12.061,15.440 11.627,15.787 Z"></path>
        </svg></a>
    </div>
    <!-- End .divider-->
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('front.account.common.message')
            </div>
            <div class="col-md-3">
                @include('front.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2 text-center">My Wishlist</h2>
                    </div>
                    <div class="card-body p-4">
                        @if ($wishlists->isNotEmpty())
                            @foreach ($wishlists as $wishlist)
                                <div class="d-sm-flex justify-content-between mt-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                    <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                        
                                        @php
                                            $productImage = getProductImage($wishlist->product_id);
                                        @endphp
                                        
                                        <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('front.product', $wishlist->product->slug) }}" style="width: 10rem;">
                                            @if (!empty($productImage))
                                                <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="Product Image" class="img-fluid" />
                                            @else
                                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default Product Image" class="img-fluid" />
                                            @endif
                                        </a>
                                        
                                        <div class="pt-2">
                                            <h3 class="product-title fs-base mb-2"><a href="{{ route('front.product', $wishlist->product->slug) }}">{{ $wishlist->product->title }}</a></h3>                                        
                                            <div class="fs-lg text-accent pt-2">
                                                <span class="h5"><strong>${{ $wishlist->product->price }}</strong></span>
                                                @if($wishlist->product->compare_price > 0)
                                                    <span class="h6 text-underline"><del>${{ $wishlist->product->compare_price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                        <button onclick="removeProduct({{ $wishlist->product_id }});" class="btn btn-outline-danger btn-sm" type="button">
                                            <i class="fas fa-trash-alt me-2"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <h3 class="h5">Your wishlist is empty!</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    function removeProduct(id) {
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: '{{ route("account.removeProductFromWishList") }}',
                type: 'post',
                data: {id:id},
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        window.location.href= "{{ route('account.wishlist') }}";
                    } 
                }
            });
        }
        
    }
</script>
@endsection