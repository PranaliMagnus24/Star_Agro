@extends('admin.layouts.layout')

@section('title', 'Job Application Details')
@section('admin')
@section('pagetitle', __('messages.Job Application Details'))

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>{{ __('messages.Job Application Details') }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('messages.ID') }}</th>
                    <td>{{ $application->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.First Name') }}</th>
                    <td>{{ $application->first_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.Last Name') }}</th>
                    <td>{{ $application->last_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.Phone') }}</th>
                    <td>{{ $application->phone }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.Email') }}</th>
                    <td>{{ $application->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.Applying For') }}</th>
                    <td>{{ $application->applying_for }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.CV') }}</th>
                    <td>
                        @if($application->cv)
                            <a href="{{ asset('upload/cv_uploads/' . $application->cv) }}" target="_blank" class="btn btn-info">View CV</a>
                            <a href="{{ asset('upload/cv_uploads/' . $application->cv) }}" download class="btn btn-success">Download CV</a>
                        @else
                            <span>No CV uploaded</span>
                        @endif
                    </td>
                </tr>
            </table>
            <a href="{{ route('admin.job.job_index') }}" class="btn btn-secondary mt-3">{{ __('messages.Back to List') }}</a>
        </div>
    </div>
</div>

@endsection
