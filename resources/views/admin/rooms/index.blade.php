@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Rooms</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('rooms.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i> Add Room
                </a>
            </div>
        </div>
    </div>
</div>
<section class="content">
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('error') }}</div>
    @endif

    {{-- Filters --}}
    <div class="card card-outline card-secondary mb-3">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-4">
                    <select name="room_type_id" class="form-control">
                        <option value="">All Room Types</option>
                        @foreach($roomTypes as $rt)
                            <option value="{{ $rt->id }}" {{ request('room_type_id') == $rt->id ? 'selected' : '' }}>{{ $rt->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status')=='available'?'selected':'' }}>Available</option>
                        <option value="booked" {{ request('status')=='booked'?'selected':'' }}>Booked</option>
                        <option value="maintenance" {{ request('status')=='maintenance'?'selected':'' }}>Maintenance</option>
                        <option value="cleaning" {{ request('status')=='cleaning'?'selected':'' }}>Cleaning</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room No.</th>
                        <th>Type</th>
                        <th>Floor</th>
                        <th>Price/Night</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td><strong>{{ $room->room_number }}</strong></td>
                        <td>{{ $room->roomType->name }}</td>
                        <td>{{ $room->floor ?? '—' }}</td>
                        <td>₹{{ number_format($room->roomType->base_price, 2) }}</td>
                        <td>
                            @php
                                $colors = ['available'=>'success','booked'=>'danger','maintenance'=>'warning','cleaning'=>'info'];
                            @endphp
                            <span class="badge badge-{{ $colors[$room->status] ?? 'secondary' }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td><small>{{ Str::limit($room->notes, 40) }}</small></td>
                        <td>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('rooms.delete', $room->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete room {{ $room->room_number }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No rooms found. <a href="{{ route('rooms.create') }}">Add rooms</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $rooms->withQueryString()->links() }}
        </div>
    </div>
</div>
</section>
@endsection
