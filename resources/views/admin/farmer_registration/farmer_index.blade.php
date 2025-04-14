@extends('admin.layouts.layout')

@section('title', 'Farmers')
@section('admin')
@section('pagetitle', __('messages.Farmers'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- <h4 class="mb-0">{{ __('messages.Farmers') }}</h4>  -->
                    <h4 class="mb-0">
    {{ __('messages.Farmers') }} 
    <span class="badge bg-success ms-2">{{ $yesCount }}</span>
</h4>

                    <div class="d-flex align-items-center">
                    
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.farmer.index') }}">
                            <div class="input-group">
                                <select name="solar_dryer" class="form-select me-2">
                                    <option value="">{{ __('messages.All') }}</option>
                                    <option value="yes" {{ request('solar_dryer') == 'yes' ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                                    <option value="no" {{ request('solar_dryer') == 'no' ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                                </select> 


                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Phone') }}</th>
                            <th>{{ __('messages.Solar Dryer') }}</th>
                            <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{ ucfirst($user->solar_dryer)}}</td>
                            <td>

                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                  </table>
                  <div class="d-flex justify-content-center">
                    {{ $users->appends(request()->query())->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
