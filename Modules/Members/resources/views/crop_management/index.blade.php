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

                        <a href="{{ route('crop.create')}}" class="btn btn-primary">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Farmer Name') }}</th>
                            <th>{{ __('messages.Crop Name') }}</th>
                            <th>{{ __('messages.Planating Date') }}</th>
                            <th>{{ __('messages.Harvesting Date') }}</th>
                            <th>{{ __('messages.Price') }}</th>
                            <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{ $datas->firstItem() + $loop->index }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ ucfirst($data->crop_name) }}</td>
                            <td>{{ $data->planating_date }}</td>
                            <td>{{ $data->harvesting_date }}</td>
                            <td>{{ $data->expected_price }}</td>
                            <td class="text-center text-nowrap">
                              {{-- <a href="{{ route('data.edit', $data->id)}}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                              <form action="{{ route('data.delete', $data->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data setting?');">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form> --}}
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                  </table>
                  <div class="d-flex justify-content-center">
                   {{$datas->links()}}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
