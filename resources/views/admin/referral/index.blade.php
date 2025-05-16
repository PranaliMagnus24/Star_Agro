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
                        <!-- <form class="d-flex me-2" method="GET" action="{{ route('admin.referral.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form> -->
                        <a href="{{ route('admin.referral.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped referralpointList">
                    <thead>
                    <tr>
                        <th>{{ __('messages.ID') }}</th>
                         <th>{{ __('messages.Referral Points') }}</th>
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
 const referralpointUrl="{{ route('admin.referral.index') }}";
</script>
