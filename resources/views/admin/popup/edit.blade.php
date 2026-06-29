
@extends('admin.layouts.app') {{-- Adjust layout if needed --}}

@section('content')

   <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Popup Message</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    

<section class="content">
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.popup.update') }}">
            @csrf

            <div class="card">
                <div class="card-header">
                           @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>


                <div class="card-body">
            

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="message" class="form-label">Popup Message</label>
                                <textarea name="message" id="message" rows="4" class="form-control">{{ old('message', $popup->message) }}</textarea>
                            </div>
                        </div>

                  <div class="col-md-4">
    <div class="mb-3">
        <label for="is_active" class="form-label">Popup Status</label>
        <select name="is_active" id="is_active" class="form-control">
            <option value="1" {{ $popup->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$popup->is_active ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
</div>

                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>
    </div>
</section>


@endsection	
		