@extends('admin.layouts.layout')

@section('title', 'messages.Referral Points Settings')
@section('admin')
@section('pagetitle', __('messages.Referral Points Settings'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Referral Points Settings') }}</h4>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.referral.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('admin.referral.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('messages.ID') }}</th>
                         <th>{{ __('messages.Referral Points') }}</th>
                        <th>{{ __('messages.Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $setting->id }}</td>
                            <td>{{ $setting->referral_points}}</td>
                            <td class="text-center text-nowrap">
                              <a href="{{ route('admin.referral.edit', $setting->id)}}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                              <form action="{{ route('admin.referral.destroy', $setting->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment gateway?');">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                  </table>
                  <div class="d-flex justify-content-center">
                   {{$settings->links()}}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
