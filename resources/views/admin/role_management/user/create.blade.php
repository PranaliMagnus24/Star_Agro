@extends('admin.layouts.layout')

@section('title', 'Users')
@section('admin')
@section('pagetitle', __('messages.User'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Create User</h4>
                    <a href="{{ route('users.list') }}" class="btn btn-primary btn-sm">{{ __('messages.Back') }}</a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">

                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="roles" class="form-label">Roles</label>
                                <select name="roles[]" id="roles" class="form-control" multiple>
                                    <option value="" disabled selected>-- Select --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
