@extends('admin.layouts.layout')

@section('title', isset($setting) ? 'Edit Referral Points Settings' : 'Create Referral Points Settings')
@section('admin')
@section('pagetitle', isset($setting) ? __('messages.Edit Referral Settings') : __('messages.Create Referral Settings'))

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ isset($setting) ? 'Edit Referral Settings' : 'Create Referral Settings' }}</h4>
            <a href="{{ route('admin.referral.index') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <form action="{{ isset($setting) ? route('admin.referral.update', $setting->id) : route('admin.referral.store') }}" method="POST">
                @csrf
                @if(isset($setting)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="referral_points">Referral Points</label>
                    <input type="number" name="referral_points" id="referral_points" class="form-control" value="{{ old('referral_points', $setting->referral_points ?? '') }}">
                    @error('referral_points')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ old('status', $setting->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $setting->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-sm btn-primary">{{ isset($setting) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
