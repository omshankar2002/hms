@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Edit Service: {{ $hotelService->name }}</h1></div>
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
            <form action="{{ route('hotel-services.update', $hotelService->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $hotelService->name) }}" required>
                            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required>
                                @foreach(['food'=>'Food & Beverage','laundry'=>'Laundry','spa'=>'Spa & Wellness','transport'=>'Transport','other'=>'Other'] as $val => $label)
                                    <option value="{{ $val }}" {{ $hotelService->category==$val?'selected':'' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">₹</span></div>
                                <input type="number" name="price" class="form-control"
                                       value="{{ old('price', $hotelService->price) }}" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit <span class="text-danger">*</span></label>
                            <select name="unit" class="form-control" required>
                                @foreach(['per item','per day','per hour','per person','per kg'] as $u)
                                    <option value="{{ $u }}" {{ $hotelService->unit==$u?'selected':'' }}>{{ ucfirst($u) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $hotelService->status=='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ $hotelService->status=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $hotelService->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Service
                </button>
                <a href="{{ route('hotel-services.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
