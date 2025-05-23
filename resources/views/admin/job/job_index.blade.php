@extends('admin.layouts.layout')

@section('title', 'Job Application')
@section('admin')
@section('pagetitle', __('messages.Job Application'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.job.job_index') }}">
                           
                        </form>
                    </div>
                    <div class="btn-group">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                {{__('messages.Export') }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/export-job">{{__('messages.Export All') }}</a></li>
                            </ul>
                        </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped" id="jobApplicationTable">
                        <thead>
                            <tr>
                                <th>{{ __('messages.ID') }}</th>
                                <th>{{ __('messages.First Name') }}</th>
                                <th>{{ __('messages.Last Name') }}</th>
                                <th>{{ __('messages.Phone') }}</th>
                                <th>{{ __('messages.Address') }}</th>
                                <th>{{ __('messages.Email') }}</th>
                                <th>{{ __('messages.Prefered Location') }}</th>
                                <!-- <th>{{ __('messages.CV') }}</th> -->
                                <th class="no-wrap">{{ __('messages.CV') }}</th>
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
<script>
    const cvUrl="{{route('admin.job.job_index') }}";
</script>

@endsection
