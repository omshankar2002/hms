@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Service</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('services.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('services.update', $service->id) }}" method="post" enctype="multipart/form-data" id="serviceForm" name="serviceForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">												
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $service->title }}" placeholder="Enter title">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description">{{ $service->description }}</textarea>
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="icon">Icon (Font Awesome class)</label>
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ $service->icon }}" placeholder="e.g. fa-solid fa-laptop">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('services.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#serviceForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true); 

    $.ajax({
        url: element.attr('action'), 
        type: 'POST', // Use POST with method spoofing for PUT
        data: element.serialize(),
        dataType: 'json', 
        success: function(response){
            $("button[type=submit]").prop('disabled', false);

            if (response.status === true) {
                window.location.href = "{{ route('services.index') }}";
            } else {
                const errors = response.errors;
                $(".error").removeClass('invalid-feedback').html('');
                $("input, textarea, select").removeClass('is-invalid');

                if(errors.title){
                    $("#title").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.title);
                }
                
                if(errors.description){
                    $("#description").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.description);
                }

                if(errors.icon){
                    $("#icon").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.icon);
                }

                if(errors.status){
                    $("#status").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.status);
                }
            }
        },
        error: function(jqXHR){
            $("button[type=submit]").prop('disabled', false);
            alert("An error occurred while submitting the form.");
        }
    });
});
</script>
@endsection
