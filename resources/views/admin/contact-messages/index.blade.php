@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact Messages</h1>
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
                            <th width="60">SN</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Created At</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($messages->isNotEmpty())
                           @foreach ($messages as $key => $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{!! Str::limit($message->message, 50) !!}</td>
                                <td>{{ $message->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('contact-messages.show', $message->id) }}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" 
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteMessage({{ $message->id }})" class="text-danger w-4 h-4 mr-1">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" 
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                           @endforeach 
                        @else
                            <tr>
                               <td colspan="5">No Messages Found</td> 
                            </tr>
                        @endif
                    </tbody>
                </table>									
            </div>
            <div class="card-footer clearfix d-flex justify-content-end">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    function deleteMessage(id){
        var url = '{{ route("contact-messages.destroy", "ID") }}';
        var newUrl = url.replace("ID", id);
        
        if (confirm("Are you sure you want to delete this message?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        window.location.href = "{{ route('contact-messages.index') }}";
                    } 
                }
            });
        }
    }
</script>
@endsection
