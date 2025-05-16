<!-- members::referral_management.details -->
@extends('members::layouts.master')

@section('title', __('messages.Referral Details'))
@section('pagetitle', __('messages.Referral Details'))

@section('member')
    <div class="container mt-5">
        <h4>{{ __('messages.Referral Link Details') }}</h4>
        <p>{{ __("Total Referrals: :count", ['count' => $totalReferrals]) }}</p>

        <!-- Referral User Details Table -->
        <div>
            <h5>{{ __('messages.User Referred by You: Details') }}</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{__('messages.Name') }}</th>
                        <th>Email</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userDetails as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/M/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
