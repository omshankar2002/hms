@extends('admin.layouts.app')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Appointments</h1>
                </div>
                <div class="col-sm-6 text-right">
                    {{-- You can add a "New Appointment" button if needed --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">

                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword"
                                    class="form-control float-right" placeholder="Search by name or email">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($appointments->isNotEmpty())
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}</td>
                                        <td>{{ $appointment->name }}</td>
                                        <td>{{ $appointment->email }}</td>
                                        <td>{{ $appointment->created_at->format('d-m-Y h:i A') }}</td>
                                        </ul>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 5px;">
                                                <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                                    class="btn btn-sm btn-info text-white" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <form action="{{ route('admin.appointments.delete', $appointment->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger btn btn-sm">
                                                        <svg class="filament-link-icon w-4 h-4"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 20 20" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No appointments found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
