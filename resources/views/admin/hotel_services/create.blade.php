@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Add Hotel Service</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('hotel-services.index') }}" class="btn btn-secondary float-right">
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
            <form action="{{ route('hotel-services.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="e.g. Room Service Breakfast" required>
                            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="">-- Select Category --</option>
                                <option value="food" {{ old('category')=='food'?'selected':'' }}>Food & Beverage</option>
                                <option value="laundry" {{ old('category')=='laundry'?'selected':'' }}>Laundry</option>
                                <option value="spa" {{ old('category')=='spa'?'selected':'' }}>Spa & Wellness</option>
                                <option value="transport" {{ old('category')=='transport'?'selected':'' }}>Transport</option>
                                <option value="other" {{ old('category')=='other'?'selected':'' }}>Other</option>
                            </select>
                            @error('category')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">₹</span></div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', 0) }}" step="0.01" min="0" required>
                            </div>
                            @error('price')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit <span class="text-danger">*</span></label>
                            <select name="unit" class="form-control" required>
                                <option value="per item" {{ old('unit','per item')=='per item'?'selected':'' }}>Per Item</option>
                                <option value="per day" {{ old('unit')=='per day'?'selected':'' }}>Per Day</option>
                                <option value="per hour" {{ old('unit')=='per hour'?'selected':'' }}>Per Hour</option>
                                <option value="per person" {{ old('unit')=='per person'?'selected':'' }}>Per Person</option>
                                <option value="per kg" {{ old('unit')=='per kg'?'selected':'' }}>Per KG</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status','active')=='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Brief description of this service...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Save Service
                </button>
                <a href="{{ route('hotel-services.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
