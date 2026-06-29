@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Send Bulk Mail</h1>
            </div>
            <div class="col-sm-6 text-right">
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <form action="" method="get">
            <div class="card-header">

                            
            </div>
            </form>    
            <div class="card-body table-responsive p-0">
                <form action="{{ route('newsletter.send') }}" method="POST" class="p-3 bg-light rounded shadow-sm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="message">Description</label>
                        <textarea name="message" id="short_description" class="summernote" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
                
            </div>
          
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
@endsection
                