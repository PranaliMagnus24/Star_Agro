@extends('admin.layouts.layout')

@section('title', 'Taluka')
@section('admin')
@section('pagetitle', __('messages.Taluka'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($taluka) ? 'Edit Taluka' : 'Create Taluka' }}</h4>
                    <a href="{{ route('talukas.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($taluka) ? route('talukas.update', $taluka->id) : route('talukas.store') }}" method="POST">
                        @csrf
                        @if(isset($taluka))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="taluka_name" class="col-md-4 col-lg-3 col-form-label">Taluka Name</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="taluka_name" id="taluka_name" class="form-control"
                                    value="{{ old('taluka_name', isset($taluka) ? $taluka->taluka_name : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="taluka_code" class="col-md-4 col-lg-3 col-form-label">Taluka Code</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="taluka_code" id="taluka_code" class="form-control"
                                    value="{{ old('taluka_code', isset($taluka) ? $taluka->taluka_code : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="district_id" class="col-md-4 col-form-label">{{ __('messages.District') }}</label>
                            <div class="col-md-8">
                                <select name="district_id" class="form-control">
                                    <option value="">-- Select District --</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ (isset($taluka) && $taluka->district_id == $district->id) ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ (isset($taluka) && $taluka->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ (isset($taluka) && $taluka->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($taluka) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
