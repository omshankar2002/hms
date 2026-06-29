@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Room Types</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('room-types.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i> Add Room Type
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

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Base Price</th>
                        <th>Max Adults</th>
                        <th>Max Children</th>
                        <th>Total Rooms</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $rt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($rt->image)
                                <img src="{{ asset($rt->image) }}" width="60" height="40" style="object-fit:cover; border-radius:4px;">
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td><strong>{{ $rt->name }}</strong></td>
                        <td>₹{{ number_format($rt->base_price, 2) }}/night</td>
                        <td>{{ $rt->max_adults }}</td>
                        <td>{{ $rt->max_children }}</td>
                        <td><span class="badge badge-info">{{ $rt->rooms_count }}</span></td>
                        <td>
                            <span class="badge badge-{{ $rt->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($rt->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('room-types.edit', $rt->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('room-types.delete', $rt->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete this room type?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No room types found. <a href="{{ route('room-types.create') }}">Add one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
@endsection
