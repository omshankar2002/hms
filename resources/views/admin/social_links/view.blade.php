@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Social Links</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('admin.social-links.update') }}" method="POST" id="socialLinksForm">
            @csrf
            <div class="card">
                <div class="card-body">											
                    <div class="row">
                        {{-- Contact fields --}}
                        <div class="col-md-12 mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   value="{{ $socialLink->phone ?? '' }}" placeholder="Enter Phone Number">
                            <p class="error"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="gmail">Gmail</label>
                            <input type="email" name="gmail" id="gmail" class="form-control"
                                   value="{{ $socialLink->gmail ?? '' }}" placeholder="Enter Gmail Address">
                            <p class="error"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   value="{{ $socialLink->address ?? '' }}" placeholder="Enter Address">
                            <p class="error"></p>
                        </div>

                        {{-- Social Links --}}
                        @foreach(['facebook', 'google', 'linkedin', 'youtube'] as $platform)
                        <div class="col-md-12 mb-3">
                            <label for="{{ $platform }}">{{ ucfirst($platform) }}</label>
                            <input type="url" name="{{ $platform }}" id="{{ $platform }}" class="form-control"
                                   value="{{ $socialLink->$platform ?? '' }}" placeholder="Enter {{ ucfirst($platform) }} URL">
                            <p class="error"></p>
                        </div>
                        @endforeach
                    </div>
                </div>							
            </div>
            <div class="pb-4 pt-2">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#socialLinksForm").submit(function(e){
    e.preventDefault();
    let form = $(this);
    $("button[type=submit]").prop("disabled", true);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop("disabled", false);
            $(".error").html('');
            $("input").removeClass('is-invalid');

            if(response.status){
                alert('Social links updated successfully!');
                location.reload();
            } else {
                $.each(response.errors, function(key, val){
                    $('#' + key).addClass('is-invalid')
                        .siblings('.error')
                        .addClass('invalid-feedback')
                        .html(val[0]);
                });
            }
        },
        error: function(){
            $("button[type=submit]").prop("disabled", false);
            alert("Something went wrong. Please try again.");
        }
    });
});
</script>
@endsection