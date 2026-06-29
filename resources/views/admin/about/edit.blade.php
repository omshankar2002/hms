@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About Section Details</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('admin.message')

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                {{-- <h4>Edit About Section Details</h4> --}}
                            </div>
                            <div class="card-body">
                                <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <!-- LEFT COLUMN -->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Heading</label>
                                                <input type="text" name="heading" class="form-control"
                                                    value="{{ old('heading', $about->heading ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Sub Heading</label>
                                                <input type="text" name="sub_heading" class="form-control"
                                                    value="{{ old('sub_heading', $about->sub_heading ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="4">{{ old('description', $about->description ?? '') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Features (comma separated)</label>
                                                <input type="text" name="features" class="form-control"
                                                    value="{{ old('features', isset($about->features) ? (is_array($about->features) ? implode(', ', $about->features) : $about->features) : '') }}">
                                                <small class="text-muted">
                                                    Example: AI-powered management, Real-time tracking, 24/7 Support
                                                </small>
                                            </div>


                                            <div class="form-group">
                                                <label>Video URL (YouTube)</label>
                                                <input type="text" name="video_url" class="form-control"
                                                    value="{{ old('video_url', $about->video_url ?? '') }}">
                                            </div>
                                        </div>

                                        <!-- RIGHT COLUMN -->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Image</label><br>
                                                        @if (!empty($about->image))
                                                            <img src="{{ asset('storage/' . $about->image) }}"
                                                                alt="About Image"
                                                                style="max-width: 100%; margin-bottom: 10px;">
                                                        @endif
                                                        <input type="file" name="image" class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-3">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
