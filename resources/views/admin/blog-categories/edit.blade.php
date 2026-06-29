@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('blog-categories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form method="POST" action="{{ route('blog-categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                        class="form-control" required>
                                    <p></p>
                                </div>
                            </div>
                    <div class="col-md-6">
    <div class="mb-3">
        <label for="status">Status</label>
        <select name="status" class="form-control" required>
            <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
</div>

                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('blog-categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
