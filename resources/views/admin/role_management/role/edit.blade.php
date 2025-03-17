@extends('admin.layouts.layout')

@section('title', 'Roles')
@section('admin')
@section('pagetitle', __('messages.Role'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Role</h4>
                    <a href="{{ route('role.list') }}" class="btn btn-primary btn-sm">{{ __('messages.Back') }}</a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" class="form-control" value={{ $role->name}}>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
