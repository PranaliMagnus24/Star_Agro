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
                        <a href="{{ route('crop.create')}}" class="btn btn-primary">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped nowrap" id="cropmanagementList">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Crop Name') }}</th>
                            <th>{{ __('messages.Planating Date') }}</th>
                            <th>{{ __('messages.Harvesting start date') }}</th>
                            <th>{{ __('messages.Harvesting end date') }}</th>
                            <th>{{ __('messages.Price') }}</th>
                            <th>{{ __('messages.Inquiry') }}</th>
                            <th>{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                  </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    const cropmanagementUrl = "{{ route('crop.index') }}";
</script>
