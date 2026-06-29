@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Testimonial</h1>
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
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="post" enctype="multipart/form-data" id="testimonialForm" name="testimonialForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">												
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $testimonial->name }}" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="comments">Comments</label>
                                <textarea name="comments" id="comments" class="form-control" rows="5" placeholder="Enter comments">{{ $testimonial->comments }}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if($testimonial->image)
                                <img src="{{ asset($testimonial->image) }}" alt="Image" width="100">
                            @endif
                            
                            </div>
                        </div> --}}
                        
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#testimonialForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true); 

    $.ajax({
        url: element.attr('action'), 
        type: 'put',  
        data: element.serialize(),
        dataType: 'json', 
        success: function(response){
            $("button[type=submit]").prop('disabled', false);

            if (response.status === true) {
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
        error: function(jqXHR, exception){
            $("button[type=submit]").prop('disabled', false);  // Re-enable submit button
            console.log("Something went wrong");
            alert("An error occurred while submitting the form. Please try again.");
        }
    });
});
</script>
@endsection
