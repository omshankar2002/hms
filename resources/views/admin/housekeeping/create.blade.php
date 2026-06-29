@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Assign Housekeeping Task</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('housekeeping.index') }}" class="btn btn-secondary float-right">
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
            <form action="{{ route('housekeeping.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Room <span class="text-danger">*</span></label>
                            <select name="room_id" class="form-control select2 @error('room_id') is-invalid @enderror" required>
                                <option value="">-- Select Room --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        Room {{ $room->room_number }} — {{ $room->roomType->name }}
                                        ({{ ucfirst($room->status) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Assigned To (Staff Name)</label>
                            <input type="text" name="assigned_to" class="form-control"
                                   value="{{ old('assigned_to') }}" placeholder="e.g. Ravi Kumar">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Task Type <span class="text-danger">*</span></label>
                            <select name="task_type" class="form-control @error('task_type') is-invalid @enderror" required>
                                <option value="cleaning" {{ old('task_type','cleaning')=='cleaning'?'selected':'' }}>Cleaning</option>
                                <option value="inspection" {{ old('task_type')=='inspection'?'selected':'' }}>Inspection</option>
                                <option value="maintenance" {{ old('task_type')=='maintenance'?'selected':'' }}>Maintenance</option>
                                <option value="setup" {{ old('task_type')=='setup'?'selected':'' }}>Setup</option>
                            </select>
                            @error('task_type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Priority <span class="text-danger">*</span></label>
                            <select name="priority" class="form-control @error('priority') is-invalid @enderror" required>
                                <option value="low" {{ old('priority')=='low'?'selected':'' }}>Low</option>
                                <option value="normal" {{ old('priority','normal')=='normal'?'selected':'' }}>Normal</option>
                                <option value="high" {{ old('priority')=='high'?'selected':'' }}>High</option>
                                <option value="urgent" {{ old('priority')=='urgent'?'selected':'' }}>Urgent</option>
                            </select>
                            @error('priority')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Scheduled Date <span class="text-danger">*</span></label>
                            <input type="date" name="scheduled_date" class="form-control @error('scheduled_date') is-invalid @enderror"
                                   value="{{ old('scheduled_date', date('Y-m-d')) }}" required>
                            @error('scheduled_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3"
                                      placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Assign Task
                </button>
                <a href="{{ route('housekeeping.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
