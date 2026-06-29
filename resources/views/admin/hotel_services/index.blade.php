@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Hotel Services</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('hotel-services.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i> Add Service
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $services->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $service->name }}</strong>
                            @if($service->description)
                                <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($service->description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            @php
                                $catColors = ['food'=>'warning','laundry'=>'info','spa'=>'success','transport'=>'primary','other'=>'secondary'];
                            @endphp
                            <span class="badge badge-{{ $catColors[$service->category] ?? 'secondary' }}">
                                {{ ucfirst($service->category) }}
                            </span>
                        </td>
                        <td>₹{{ number_format($service->price, 2) }}</td>
                        <td>{{ $service->unit }}</td>
                        <td>
                            <span class="badge badge-{{ $service->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($service->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('hotel-services.edit', $service->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('hotel-services.delete', $service->id) }}" method="POST"
                                  style="display:inline" onsubmit="return confirm('Delete this service?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No services found. <a href="{{ route('hotel-services.create') }}">Add one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $services->links() }}</div>
    </div>
</div>
</section>
@endsection
