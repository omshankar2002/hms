@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscribers List </h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subscribers.export') }}" class="btn btn-primary">Export Data</a>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">

                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword"
                                    class="form-control float-right" placeholder="Search">

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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Email</th>
                                <th>Subscribed At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $index => $subscriber)
                                <tr>
                                    <td>{{ ($subscribers->currentPage() - 1) * $subscribers->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>{{ $subscriber->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('newsletter.delete', $subscriber->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix d-flex justify-content-end">
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
@endsection
