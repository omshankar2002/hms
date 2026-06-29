@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Content</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('manage_content.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('manage_content.store') }}" method="post" id="contentForm" name="contentForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" 
                                    class="form-control" placeholder="Enter title">
                                <p class="error"></p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
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
                <a href="{{ route('manage_content.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#contentForm").submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    $("button[type=submit]").prop('disabled', true);

    $.ajax({
    url: '{{ route("manage_content.store") }}',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function(response) {
        $("button[type=submit]").prop('disabled', false);
        
        if (response.status === true) {
            // Redirect to the index page without alert
            window.location.href = "{{ route('manage_content.index') }}";
        } else {
            // Handle validation errors
            const errors = response.errors;
            $(".error").removeClass('invalid-feedback').html('');
            $("input, textarea").removeClass('is-invalid');

            if (errors.title) {
                $("#title").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.title);
            }

            if (errors.description) {
                $("#description").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.description);
            }

            if (errors.image) {
                $("#image").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.image);
            }
        }
    },
    error: function() {
        console.log("Something went wrong");
        $("button[type=submit]").prop('disabled', false);
    }
});


});
</script>
@endsection
