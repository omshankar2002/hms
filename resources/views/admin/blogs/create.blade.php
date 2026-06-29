@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ADD New Blog</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Back</a>
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
                                <h4>Create Post</h4>

                            </div>
                            <div class="card-body">
                                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Slug <span class="text-danger">*</span></label>
                                                <input type="text" name="slug" id="slug" class="form-control"
                                                    value="{{ old('slug') }}">

                                            </div>

                                            <div class="form-group">
                                                <label>Category <span class="text-danger">*</span></label>

                                                <select name="category_id" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="description" class="summernote">{{ old('description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Tags <span class="text-danger">*</span></label>
                                                        <input type="text" name="tags" class="form-control tags"
                                                            value="{{ old('tags') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>SEO Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="seo_title" class="form-control"
                                                            value="{{ old('seo_title') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>SEO Description <span class="text-danger">*</span></label>
                                                        <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Featured Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="image" class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success">Save</button>
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


@section('scripts')
    <script>
        // Slug Generation
        document.getElementById('title').addEventListener('input', function() {
            let slug = this.value.toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
            console.log(slug); // Check if the slug is being generated
            document.getElementById('slug').value = slug;
        });


        // Summernote Initialization
        $('.summernote').summernote({
            height: 300
        });

        // Tagify Initialization (यहाँ डालें)
        var input = document.querySelector('input[name="tags"]');
        new Tagify(input);
    </script>
@endsection
