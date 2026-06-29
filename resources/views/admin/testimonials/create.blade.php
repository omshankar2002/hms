@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Testimonials</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('testimonials.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('testimonials.store') }}" method="post" id="feedbackForm" name="feedbackForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" 
                                    class="form-control" placeholder="Enter your name">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="comments">Comments</label>
                                <textarea name="comments" id="comments" class="form-control" 
                                    rows="4" placeholder="Enter your comments"></textarea>
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#feedbackForm").submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    $("button[type=submit]").prop('disabled', true);

    $.ajax({
        url: '{{ route("testimonials.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled', false);
            
            if (response.status === true) {
                $(".error").removeClass('invalid-feedback').html('');
                $("input, textarea").removeClass('is-invalid');
                window.location.href = "{{ route('testimonials.index') }}";
            } else {
                const errors = response.errors;
                $(".error").removeClass('invalid-feedback').html('');
                $("input, textarea").removeClass('is-invalid');

                if(errors.name){
                    $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.name);
                }

                if(errors.comments){
                    $("#comments").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.comments);
                }

                if(errors.image){
                    $("#image").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.image);
                }
            }
        },
        error: function(){
            console.log("Something went wrong");
            $("button[type=submit]").prop('disabled', false);
        }
    });
});
</script>
@endsection
