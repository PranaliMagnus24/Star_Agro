@extends('members::layouts.master')

@section('title', __('messages.Crop Management'))
@section('pagetitle', __('messages.Crop Management'))
@section('member')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="#">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('crop.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            {{-- <th>{{ __('messages.Farmer Name') }}</th> --}}
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Phone') }}</th>
                            <th>{{ __('messages.Description') }}</th>
                            <th>{{ __('messages.City') }}</th>
                            <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiries->firstItem() + $loop->index }}</td>
                            <td>{{ $inquiry->name }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->mobile_number }}</td>
                            <td>{{ $inquiry->description }}</td>
                            <td>{{ $inquiry->city }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>

                  </table>
                  <div class="d-flex justify-content-center">
                   {{$inquiries->links()}}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
