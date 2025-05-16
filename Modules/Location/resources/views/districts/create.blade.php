@extends('admin.layouts.layout')

@section('title', 'District')
@section('admin')
@section('pagetitle', __('messages.District'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($district) ? 'Edit District' : 'Create District' }}</h4>
                    <a href="{{ route('districts.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($district) ? route('districts.update', $district->id) : route('districts.store') }}" method="POST">
                        @csrf
                        @if(isset($district))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="district_name" class="col-md-4 col-lg-3 col-form-label">District Name</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="district_name" id="district_name" class="form-control"
                                    value="{{ old('district_name', isset($district) ? $district->district_name : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="district_code" class="col-md-4 col-lg-3 col-form-label">District Code</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="district_code" id="district_code" class="form-control"
                                    value="{{ old('district_code', isset($district) ? $district->district_code : '') }}">
                            </div>
                        </div>

                       <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <label for="state"
                                                    class="col-md-4 col-form-label">{{ __('messages.State') }}</label>
                                                <div class="col-md-8">
                                                    <select name="state_id" id="state-dropdown" class="form-control">
                                                        <option value="">-- Select State --</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                {{ $state->id == 4008 ? 'selected' : '' }}>
                                                                {{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ (isset($district) && $district->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ (isset($district) && $district->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($district) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
