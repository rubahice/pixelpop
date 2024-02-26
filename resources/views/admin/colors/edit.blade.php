@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Edit Colors
                    <a href="{{ url('admin/colors') }}" class="btn btn-rounded btn-danger btn-sm text-white btn-sm float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/colors/'.$color->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br />
                        <input type="checkbox" name="status" {{ $color->status ? 'checked':'' }} style="width: 20px; height: 20px;" /> Checked = Hidden, UnChecked = Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary text-white float-end">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
