@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Edit Room: {{ $room->room_number }}</h1></div>
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
            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Room Number <span class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control @error('room_number') is-invalid @enderror"
                                   value="{{ old('room_number', $room->room_number) }}">
                            @error('room_number')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Room Type <span class="text-danger">*</span></label>
                            <select name="room_type_id" class="form-control select2">
                                @foreach($roomTypes as $rt)
                                    <option value="{{ $rt->id }}" {{ $room->room_type_id == $rt->id ? 'selected' : '' }}>
                                        {{ $rt->name }} (₹{{ number_format($rt->base_price, 2) }}/night)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Floor</label>
                            <input type="text" name="floor" class="form-control" value="{{ old('floor', $room->floor) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="available" {{ $room->status=='available'?'selected':'' }}>Available</option>
                                <option value="booked" {{ $room->status=='booked'?'selected':'' }}>Booked</option>
                                <option value="maintenance" {{ $room->status=='maintenance'?'selected':'' }}>Maintenance</option>
                                <option value="cleaning" {{ $room->status=='cleaning'?'selected':'' }}>Cleaning</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $room->notes) }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Room
                </button>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
