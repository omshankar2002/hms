@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Message Details</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('contact-messages.index') }}" class="btn btn-default float-right">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Name:</h5>
                            <p>{{ $contactMessage->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Email:</h5>
                            <p>{{ $contactMessage->email }}</p>
                        </div>
                        <div class="col-md-12">
                            <h5>Subject:</h5>
                            <p>{{ $contactMessage->subject }}</p>
                        </div>
                        <div class="col-md-12">
                            <h5>Message:</h5>
                            <p>{{ $contactMessage->message }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Received At:</h5>
                            <p>{{ $contactMessage->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection