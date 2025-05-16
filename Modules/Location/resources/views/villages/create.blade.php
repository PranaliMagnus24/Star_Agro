@extends('admin.layouts.layout')

@section('title', 'Village')
@section('admin')
@section('pagetitle', __('messages.Village'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($village) ? 'Edit Village' : 'Create Village' }}</h4>
                    <a href="{{ route('villages.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($village) ? route('villages.update', $village->id) : route('villages.store') }}" method="POST">
                        @csrf
                        @if(isset($village))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="village_name" class="col-md-4 col-lg-3 col-form-label">Village Name</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="village_name" id="village_name" class="form-control"
                                    value="{{ old('village_name', isset($village) ? $village->village_name : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="village_code" class="col-md-4 col-lg-3 col-form-label">Village Code</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="village_code" id="village_code" class="form-control"
                                    value="{{ old('village_code', isset($village) ? $village->village_code : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="taluka_id" class="col-md-4 col-form-label">{{ __('messages.Taluka') }}</label>
                            <div class="col-md-8">
                                <select name="taluka_id" class="form-control">
                                    <option value="">-- Select Taluka --</option>
                                    @foreach ($talukas as $taluka)
                                        <option value="{{ $taluka->id }}"
                                            {{ (isset($village) && $village->taluka_id == $taluka->id) ? 'selected' : '' }}>
                                            {{ $taluka->taluka_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('taluka_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="village_category" class="col-md-4 col-lg-3 col-form-label">Village Category</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="village_category" id="village_category" class="form-control">
                                    <option value="Rural" {{ (isset($village) && $village->village_category == 'Rural') ? 'selected' : '' }}>Rural</option>
                                    <option value="Urban" {{ (isset($village) && $village->village_category == 'Urban') ? 'selected' : '' }}>Urban</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ (isset($village) && $village->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ (isset($village) && $village->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($village) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
