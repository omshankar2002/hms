@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Change Password</h2>
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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Change Password</a></li>
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
<section class="login" id="changePasswordSection">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Include Common Message -->
                @include('front.account.common.message')
            </div>
            <div class="col-md-3">
                <!-- Include Sidebar -->
                @include('front.account.common.sidebar')
            </div>

            <!-- Form Section -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <div class="login-card">
                            <div class="heading heading-1 text--center">
                                <h2 class="heading-title">Change Your Password</h2>
                            </div>
                            <div class="login-body">
                                <form class="loginForm mb-0" method="post" action="" id="changePasswordForm" name="changePasswordForm">
                                    @csrf
                                    <div class="row">
                                        <!-- Old Password Field -->
                                        <div class="col-12 mb-3">
                                            <label for="old_password">Old Password <span class="required">*</span></label>
                                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- New Password Field -->
                                        <div class="col-12 mb-3">
                                            <label for="new_password">New Password <span class="required">*</span></label>
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Confirm Password Field -->
                                        <div class="col-12 mb-3">
                                            <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Old Password" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn--primary btn-block btn-lg">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script type="text/javascript">
$("#changePasswordForm").submit(function(e){
    e.preventDefault();

    $("#submit").prop('disabled',true);

    $.ajax({
        url: '{{ route("account.processChangePassword") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
            $("#submit").prop('disabled',false);

            if (response.status == true) {
                window.location.href="{{ route('account.changePassword') }}";
            } else {
                var errors = response.errors;

                if (errors.old_password) {
                    $("#old_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.old_password)
                } else{
                    $("#old_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                }

                if (errors.new_password) {
                    $("#new_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.new_password)
                } else{
                    $("#new_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                }

                if (errors.confirm_password) {
                    $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password)
                } else{
                    $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                }
            }
        }
    });
});
</script>
@endsection