@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Banner</h1>
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
                                <h4>Edit Banner Details</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Subtitle</label>
                                                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Title</label>
                                                <textarea name="title" class="form-control" rows="3">{{ old('title', $banner->title ?? '') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="5">{{ old('description', $banner->description ?? '') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Button Text</label>
                                                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Button URL</label>
                                                <input type="url" name="button_url" class="form-control" value="{{ old('button_url', $banner->button_url ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Clients Count</label>
                                                <input type="number" name="clients_count" class="form-control" value="{{ old('clients_count', $banner->clients_count ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Uptime (e.g. 99.9%)</label>
                                                <input type="text" name="uptime" class="form-control" value="{{ old('uptime', $banner->uptime ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Support Hours (e.g. 24/7)</label>
                                                <input type="text" name="support_hours" class="form-control" value="{{ old('support_hours', $banner->support_hours ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <label>Background Image</label><br>
                                                        @if(!empty($banner->background_image))
                                                            <img src="{{ asset($banner->background_image) }}" alt="Background Image" style="max-width: 100%; margin-bottom: 10px;">
                                                        @endif
                                                        <input type="file" name="background_image" class="form-control-file">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Hero Image 1 (Map)</label><br>
                                                        @if(!empty($banner->hero_image_1))
                                                            <img src="{{ asset($banner->hero_image_1) }}" alt="Hero Image 1" style="max-width: 100%; margin-bottom: 10px;">
                                                        @endif
                                                        <input type="file" name="hero_image_1" class="form-control-file">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Hero Image 2 (Truck)</label><br>
                                                        @if(!empty($banner->hero_image_2))
                                                            <img src="{{ asset($banner->hero_image_2) }}" alt="Hero Image 2" style="max-width: 100%; margin-bottom: 10px;">
                                                        @endif
                                                        <input type="file" name="hero_image_2" class="form-control-file">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-3">
                                        <button type="submit" class="btn btn-success">Update Banner</button>
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
