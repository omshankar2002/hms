@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Profile</h2>
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
          <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
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

<section class="login" id="personalInfoSection">
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

            <!-- Personal Information Form -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <div class="login-card">
                            <div class="heading heading-1 text--center">
                                <h2 class="heading-title">Personal Information</h2>
                            </div>
                            <div class="login-body">
                                <form class="loginForm mb-0" method="post" action="" name="profileForm" id="profileForm">
                                    @csrf
                                    <div class="row">
                                        <!-- Name Field -->
                                        <div class="col-12 mb-3">
                                            <label for="name">Name <span class="required">*</span></label>
                                            <input value="{{ $user->name }}" type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-12 mb-3">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input  value="{{ $user->email }}"  type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Phone Field -->
                                        <div class="col-12 mb-3">
                                            <label for="phone">Phone <span class="required">*</span></label>
                                            <input  value="{{ $user->phone }}"  type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <button class="btn btn--primary btn-block btn-lg">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   <br>
                   <br>
                   <br>
                    <div class="col-12 mt-5">
                        <div class="login-card">
                            <div class="heading heading-1 text--center">
                                <h2 class="heading-title">Address</h2>
                            </div>
                            <div class="login-body">
                                <form action="" name="addressForm" id="addressForm">
                                    <div class="row">
                                        <!-- First Name Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="first_name">First Name <span class="required">*</span></label>
                                            <input value="{{ (!empty($address)) ? $address->first_name : '' }}" type="text" name="first_name" id="first_name" placeholder="Enter Your First Name" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Last Name Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name">Last Name <span class="required">*</span></label>
                                            <input value="{{ (!empty($address)) ? $address->last_name : '' }}" type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Email Field (Address) -->
                                        <div class="col-md-6 mb-3">
                                            <label for="address_email">Email</label>
                                            <input  value="{{ (!empty($address)) ? $address->email : '' }}"  type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Mobile Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile <span class="required">*</span></label>
                                            <input  value="{{ (!empty($address)) ? $address->mobile : '' }}"  type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile No." class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Country Selection -->
                                        <div class="col-12 mb-3">
                                            <label for="country_id">Country <span class="required">*</span></label>
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Select a Country</option>
                                                @if ($countries->isNotEmpty())
                                                    @foreach ($countries as $country)
                                                    <option {{ (!empty($address) &&  $address->country_id == $country->id ) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p></p>
                                        </div>

                                        <!-- Address Field -->
                                        <div class="col-12 mb-3">
                                            <label for="address">Address <span class="required">*</span></label>
                                            <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{  (!empty($address)) ? $address->address : '' }}</textarea>
                                            <p></p>
                                        </div>

                                        <!-- Apartment Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="apartment">Apartment</label>
                                            <input  value="{{ (!empty($address)) ? $address->apartment : '' }}"  type="text" name="apartment" id="apartment" placeholder="Apartment" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- City Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="city">City <span class="required">*</span></label>
                                            <input  value="{{ (!empty($address)) ? $address->city : '' }}"  type="text" name="city" id="city" placeholder="City" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- State Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="state">State <span class="required">*</span></label>
                                            <input  value="{{ (!empty($address)) ? $address->state : '' }}"  type="text" name="state" id="state" placeholder="State" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Zip Code Field -->
                                        <div class="col-md-6 mb-3">
                                            <label for="zip">Zip <span class="required">*</span></label>
                                            <input  value="{{ (!empty($address)) ? $address->zip : '' }}"  type="text" name="zip" id="zip" placeholder="Zip" class="form-control">
                                            <p></p>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <button class="btn btn--primary btn-block btn-lg">Update</button>
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
<script>
    $("#profileForm").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: '{{ route("account.updateProfile") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if (response.status == true) {

                    $("#profileForm #name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    $("#profileForm #phone")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    $("#profileForm #email")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    window.location.href = '{{  route("account.profile") }}';

                } else {
                    var errors = response.errors;
                    if (errors.name) {
                        $("#profileForm #name").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.name)
                        .addClass('invalid-feedback');
                    } else {
                        $("#profileForm #name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');
                    }

                    if (errors.email) {
                        $("#profileForm #email")
                        .addClass('is-invalid')
                        .siblings('p')
                        .html(errors.email)
                        .addClass('invalid-feedback');
                    } else {
                        $("#profileForm #email")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.phone) {
                        $("#profileForm #phone").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.phone)
                        .addClass('invalid-feedback');
                    } else {
                        $("#profileForm #phone").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }
                }
            }
        });
    });


    $("#addressForm").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: '{{ route("account.updateAddress") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if (response.status == true) {

                    $("#name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    $("#phone")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    $("#email")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');

                    window.location.href = '{{  route("account.profile") }}';

                } else {
                    var errors = response.errors;
                    if (errors.first_name) {
                        $("#first_name").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.first_name)
                        .addClass('invalid-feedback');
                    } else {
                        $("#first_name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');
                    }

                    if (errors.last_name) {
                        $("#last_name").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.last_name)
                        .addClass('invalid-feedback');
                    } else {
                        $("#last_name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');
                    }

                    if (errors.email) {
                        $("#addressForm #email")
                        .addClass('is-invalid')
                        .siblings('p')
                        .html(errors.email)
                        .addClass('invalid-feedback');
                    } else {
                        $("#addressForm #email")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.mobile) {
                        $("#mobile").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.mobile)
                        .addClass('invalid-feedback');
                    } else {
                        $("#mobile").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.country_id) {
                        $("#country_id").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.country_id)
                        .addClass('invalid-feedback');
                    } else {
                        $("#country_id").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.address) {
                        $("#address").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.address)
                        .addClass('invalid-feedback');
                    } else {
                        $("#address").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.apartment) {
                        $("#apartment").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.apartment)
                        .addClass('invalid-feedback');
                    } else {
                        $("#apartment").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.city) {
                        $("#city").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.city)
                        .addClass('invalid-feedback');
                    } else {
                        $("#city").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.state) {
                        $("#state").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.state)
                        .addClass('invalid-feedback');
                    } else {
                        $("#state").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }

                    if (errors.zip) {
                        $("#zip").addClass('is-invalid')
                        .siblings('p')
                        .html(errors.zip)
                        .addClass('invalid-feedback');
                    } else {
                        $("#zip").removeClass('is-invalid')
                        .siblings('p')
                        .html('')
                        .removeClass('invalid-feedback');;
                    }
                }
            }
        });
    });

    // addressForm
</script>
    
@endsection