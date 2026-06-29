@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Guest Management</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('guests.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-user-plus mr-1"></i> Add Guest
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

    <div class="card card-outline card-secondary mb-3">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, phone or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                    <a href="{{ route('guests.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Nationality</th>
                        <th>Bookings</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $guest)
                    <tr>
                        <td>{{ $guests->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('guests.show', $guest->id) }}">
                                <strong>{{ $guest->name }}</strong>
                            </a>
                        </td>
                        <td>{{ $guest->phone }}</td>
                        <td>{{ $guest->email ?? '—' }}</td>
                        <td>{{ $guest->nationality ?? '—' }}</td>
                        <td><span class="badge badge-info">{{ $guest->bookings_count }}</span></td>
                        <td>{{ $guest->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('guests.delete', $guest->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete guest {{ $guest->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No guests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $guests->withQueryString()->links() }}</div>
    </div>
</div>
</section>
@endsection
