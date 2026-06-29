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
                <a href="{{ route('manage_content.create') }}" class="btn btn-primary">Add Content</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($manageContents->isNotEmpty())
                        @foreach ($manageContents as $content)
                        <tr id="row-{{ $content->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $content->title }}</td>
                            <td>{{ Str::limit($content->description, 50) }}</td>
                            <td>
                                @if ($content->image)
                                    <img src="{{ asset('uploads/manage_content/'.$content->image) }}" alt="{{ $content->title }}" width="100" />
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('manage_content.edit', $content->id) }}"> <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg></a>
                                <a href="#" class="text-danger w-4 h-4 mr-1" onclick="deleteContent({{ $content->id }})"><svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg></a>
                            </td>
                        </tr>
                    @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Content Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
  function deleteContent(id) {
    var url = '{{ route("manage_content.delete", ":id") }}';
    url = url.replace(':id', id);

    if (confirm("Are you sure you want to delete this content?")) {
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    // Remove the deleted row
                    $('#row-' + id).remove();

                    // Show success message
                    $('#success-message')
                        .text(response.message)
                        .fadeIn()
                        .delay(2000)
                        .fadeOut();
                }
            },
            error: function() {
                alert('Something went wrong. Try again.');
            }
        });
    }
}

</script>
@endsection
