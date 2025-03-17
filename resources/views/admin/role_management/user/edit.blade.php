@extends('admin.layouts.layout')

@section('title', 'Users')
@section('admin')
@section('pagetitle', __('messages.User'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit User</h4>
                    <a href="{{ route('users.list') }}" class="btn btn-primary btn-sm">{{ __('messages.Back') }}</a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value={{ $user->name}}>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" value={{ $user->email}}>
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                <option value=""> --Select-- </option>
                                @foreach($roles as $role)
                                <option value="{{$role}}" {{ in_array($role, $userRoles) ? 'selected':'' }}>{{$role}}</option>
                                @endforeach
                            </select>
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
