@extends('admin.layouts.layout')

@section('title', isset($setting) ? 'Edit Points Settings' : 'Create Points Settings')
@section('admin')
@section('pagetitle', isset($setting) ? __('messages.Edit Points Settings') : __('messages.Create Points Settings'))

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ isset($setting) ? 'Edit Points Settings' : 'Create Points Settings' }}</h4>
            <a href="{{ route('admin.points.index') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <form action="{{ isset($setting) ? route('admin.points.update', $setting->id) : route('admin.points.store') }}" method="POST">
                @csrf
                @if(isset($setting)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="points_per_inquiry">Points per Inquiry</label>
                    <input type="number" name="points_per_inquiry" id="points_per_inquiry" class="form-control" value="{{ old('points_per_inquiry', $setting->points_per_inquiry ?? '') }}">
                    @error('points_per_inquiry')
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
