@extends('front.layouts.app')

@section('content')

<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Register</h2>
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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Register</a></li>
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
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="login-card">
                    <div class="heading heading-1 text--center">
                        <h2 class="heading-title">Create Your Account</h2>
                    </div>
                    <div class="login-body">
                        <form class="loginForm mb-0" method="post" action="" name="registrationForm" id="registrationForm">
                          @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="full-name">Full Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                                    <p></p>
                                </div>

                                <div class="col-12">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                                    <p></p>
                                </div>

                                <div class="col-12">
                                    <label for="password">Password<span class="required">*</span></label>
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                    <p></p>
                                </div>

                                <div class="col-12">
                                    <label for="confirm-password">Confirm Password<span class="required">*</span></label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                                    <p></p>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn--primary">Sign Up</button>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="login-result">
                                        <p>Already have an account? <a href="{{ route('account.login') }}">Login</a></p>
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


@section('customJs')

<script type="text/javascript">

$("#registrationForm").submit(function(event){
    event.preventDefault();

    $("button[type='submit']").prop('disabled',true);

    $.ajax({
        url: '{{ route("account.processRegister") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type='submit']").prop('disabled',false);

            var errors = response.errors;

            if (response.status == false) {
                if (errors.name) {
                    $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                    $("#name").addClass('is-invalid');
                } else {
                    $("#name").siblings("p").removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');
                }

                if (errors.email) {
                    $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                    $("#email").addClass('is-invalid');
                } else {
                    $("#email").siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');
                }

                if (errors.password) {
                    $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                    $("#password").addClass('is-invalid');
                } else {
                    $("#password").siblings("p").removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');
                }
            } else {

                $("#name").siblings("p").removeClass('invalid-feedback').html('');
                $("#name").removeClass('is-invalid');

                $("#email").siblings("p").removeClass('invalid-feedback').html('');
                $("#email").removeClass('is-invalid');

                $("#password").siblings("p").removeClass('invalid-feedback').html('');
                $("#password").removeClass('is-invalid');

                window.location.href="{{ route('account.login') }}";

            }

        },
        error: function(jQXHR, execption) {
            console.log("Something went wrong");
        }
    });
});

</script>


@endsection