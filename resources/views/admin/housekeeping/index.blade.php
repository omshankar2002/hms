@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Housekeeping Tasks</h1></div>
            <div class="col-sm-6">
                <a href="{{ route('housekeeping.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i> Assign Task
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

    <div class="card card-outline card-secondary mb-3">
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date', date('Y-m-d')) }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>In Progress</option>
                        <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                        <option value="skipped" {{ request('status')=='skipped'?'selected':'' }}>Skipped</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('housekeeping.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Task Type</th>
                        <th>Priority</th>
                        <th>Assigned To</th>
                        <th>Scheduled</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    @php
                        $statusColors   = ['pending'=>'warning','in_progress'=>'info','completed'=>'success','skipped'=>'secondary'];
                        $priorityColors = ['low'=>'secondary','normal'=>'info','high'=>'warning','urgent'=>'danger'];
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $task->room->room_number }}</strong><br>
                            <small class="text-muted">{{ $task->room->roomType->name }}</small>
                        </td>
                        <td>{{ ucfirst($task->task_type) }}</td>
                        <td>
                            <span class="badge badge-{{ $priorityColors[$task->priority] ?? 'secondary' }}">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </td>
                        <td>{{ $task->assigned_to ?? '—' }}</td>
                        <td>{{ $task->scheduled_date->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('housekeeping.updateStatus', $task->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-control form-control-sm" style="width:120px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $task->status=='pending'?'selected':'' }}>Pending</option>
                                    <option value="in_progress" {{ $task->status=='in_progress'?'selected':'' }}>In Progress</option>
                                    <option value="completed" {{ $task->status=='completed'?'selected':'' }}>Completed</option>
                                    <option value="skipped" {{ $task->status=='skipped'?'selected':'' }}>Skipped</option>
                                </select>
                            </form>
                        </td>
                        <td><small>{{ \Illuminate\Support\Str::limit($task->notes, 40) }}</small></td>
                        <td>
                            <form action="{{ route('housekeeping.delete', $task->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete this task?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No housekeeping tasks found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $tasks->withQueryString()->links() }}</div>
    </div>
</div>
</section>
@endsection
