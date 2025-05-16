@extends('admin.layouts.layout')

@section('title', 'Wallet Points Settings')
@section('admin')
@section('pagetitle', __('messages.Wallet Points Settings'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Wallet Points Settings') }}</h4>
                    <div class="d-flex align-items-center">
                        <!-- <form class="d-flex me-2" method="GET" action="{{ route('admin.points.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form> -->
                        <a href="{{ route('admin.points.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped walletpointList">
                    <thead>
                    <tr>
                             <th>ID</th>
                            <th>Points per Inquiry</th>
                            <th>Actions</th>
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
    const walletpointUrl="{{ route('admin.points.index') }}";
</script>
