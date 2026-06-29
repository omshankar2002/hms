@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit FAQ</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('faqs.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('faqs.update', $faq->id) }}" method="post" id="faqForm" name="faqForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="question">Question</label>
                                <input type="text" name="question" id="question" 
                                    class="form-control" placeholder="Enter Question"
                                    value="{{ $faq->question }}">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="answer">Answer</label>
                                <textarea name="answer" id="answer" class="form-control" 
                                    rows="5" placeholder="Enter Answer">{{ $faq->answer }}</textarea>
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ ($faq->status == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($faq->status == 0) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('faqs.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#faqForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true);
    
    $.ajax({
        url: element.attr('action'),
        type: 'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled', false);

            if (response.status === true) {
                $(".error").removeClass('invalid-feedback').html('');
                $("input, textarea").removeClass('is-invalid');
                window.location.href = "{{ route('faqs.index') }}";
            } else {
                const errors = response.errors;
                $(".error").removeClass('invalid-feedback').html('');
                $("input, textarea").removeClass('is-invalid');

                if(errors.question){
                    $("#question").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.question);
                }
                
                if(errors.answer){
                    $("#answer").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.answer);
                }
            }
        },
        error: function(jqXHR, exception){
            console.log("Something went wrong");
        }
    });
});
</script>
@endsection