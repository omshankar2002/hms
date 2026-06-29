@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Forgot Password</h2>
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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Forgot Password</a></li>
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

<section class="login" id="login2">
    <div class="container">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="login-card">
                    <div class="heading heading-1 text--center">
                        <h2 class="heading-title">Forgot your password?</h2>
                    </div>
                    <div class="login-body">
                        <form class="loginForm mb-0" method="post" action="{{ route('front.processForgotPassword') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                              
                                <div class="col-12">
                                    <input class="btn btn--primary" type="submit" value="Send Reset Link" />
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="login-result">
                                        <p>Already have an account? <a href="{{ route('account.login') }}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End .login-body -->
                </div>
                <!-- End .login-card -->
            </div>
            <!-- End .col-xl-6-->
        </div>
        <!-- End .row-->
    </div>
    <!-- End .container-->
</section>
@endsection