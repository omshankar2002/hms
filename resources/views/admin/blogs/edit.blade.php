@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Blog</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('blogs.index') }}" class="btn btn-primary">Back</a>
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
                            <h4>Edit Blog</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Slug <span class="text-danger">*</span></label>
                                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $blog->slug) }}">
                                        </div>

                                        
<div class="form-group">
    <label>Category <span class="text-danger">*</span></label>
    <select name="category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @if(old('category_id', isset($blog) ? $blog->category_id : '') == $category->id) selected @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


                                        

                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="summernote">{{ old('description', $blog->description) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ old('status', $blog->status) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $blog->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input type="text" name="tags" class="form-control" value="{{ old('tags', $blog->tags) }}">
                                        </div>

                                        <div class="form-group">
                                            <label>SEO Title</label>
                                            <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $blog->seo_title) }}">
                                        </div>

                                        <div class="form-group">
                                            <label>SEO Description</label>
                                            <textarea name="seo_description" class="form-control">{{ old('seo_description', $blog->seo_description) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input type="file" name="image" class="form-control-file">
                                            @if($blog->image)
                                                <img src="{{ asset('upload/blogs' . $blog->image) }}" alt="Blog Image" width="100" class="mt-2">
                                            @endif
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
   document.getElementById('title').addEventListener('input', function() {
    let slug = this.value.toLowerCase()
        .replace(/\s+/g, '-') // replace spaces with hyphens
        .replace(/[^\w\-]+/g, '') // remove all non-word characters
        .replace(/\-\-+/g, '-') // replace multiple hyphens with a single one
        .replace(/^-+/, '') // remove leading hyphens
        .replace(/-+$/, ''); // remove trailing hyphens
    document.getElementById('slug').value = slug; // update the slug input field
});

</script>
@endsection
