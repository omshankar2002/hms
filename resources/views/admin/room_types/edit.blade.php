@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Edit Room Type: {{ $roomType->name }}</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('room-types.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('room-types.update', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Room Type Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $roomType->name) }}">
                            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control summernote" rows="4">{{ old('description', $roomType->description) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Base Price (per night) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">₹</span></div>
                                        <input type="number" name="base_price" class="form-control"
                                               value="{{ old('base_price', $roomType->base_price) }}" step="0.01" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Max Adults</label>
                                    <input type="number" name="max_adults" class="form-control" value="{{ old('max_adults', $roomType->max_adults) }}" min="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Max Children</label>
                                    <input type="number" name="max_children" class="form-control" value="{{ old('max_children', $roomType->max_children) }}" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room Type Image</label>
                            @if($roomType->image)
                                <div class="mb-2">
                                    <img src="{{ asset($roomType->image) }}" id="imagePreview" style="max-width:100%; border-radius:6px;">
                                </div>
                            @else
                                <img id="imagePreview" src="" style="max-width:100%; display:none; border-radius:6px;">
                            @endif
                            <input type="file" name="image" class="form-control-file mt-2" accept="image/*" id="imageInput">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $roomType->status=='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ $roomType->status=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Room Type
                </button>
                <a href="{{ route('room-types.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection

@section('customJs')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    if (this.files && this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.style.display = 'block';
    }
});
</script>
@endsection
