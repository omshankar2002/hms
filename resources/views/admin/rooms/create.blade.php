@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Add Room</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary float-right">
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
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Room Number <span class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control @error('room_number') is-invalid @enderror"
                                   value="{{ old('room_number') }}" placeholder="e.g. 101, 201A">
                            @error('room_number')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Room Type <span class="text-danger">*</span></label>
                            <select name="room_type_id" class="form-control select2 @error('room_type_id') is-invalid @enderror">
                                <option value="">-- Select Room Type --</option>
                                @foreach($roomTypes as $rt)
                                    <option value="{{ $rt->id }}" {{ old('room_type_id') == $rt->id ? 'selected' : '' }}>
                                        {{ $rt->name }} (₹{{ number_format($rt->base_price, 2) }}/night)
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Floor</label>
                            <input type="text" name="floor" class="form-control" value="{{ old('floor') }}" placeholder="e.g. Ground, 1st, 2nd">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="available" {{ old('status','available')=='available'?'selected':'' }}>Available</option>
                                <option value="maintenance" {{ old('status')=='maintenance'?'selected':'' }}>Maintenance</option>
                                <option value="cleaning" {{ old('status')=='cleaning'?'selected':'' }}>Cleaning</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Any special notes about this room...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Save Room
                </button>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
