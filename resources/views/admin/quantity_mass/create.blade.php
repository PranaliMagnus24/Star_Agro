@extends('admin.layouts.layout')

@section('title', 'Unit Mass')
@section('admin')
@section('pagetitle', __('messages.UnitMass'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($unitmass) ? 'Edit Unit Mass' : 'Create Unit Mass' }}</h4>
                    <a href="{{ route('admin.quantityMass.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-skip-backward-fill"></i>
                    </a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($unitmass) ? route('admin.quantityMass.update', $unitmass->id) : route('admin.quantityMass.store') }}" method="POST">
                        @csrf
                        @if(isset($unitmass))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Name') }}</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($unitmass) ? $unitmass->name : '') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Description')}}</label>
                            <div class="col-md-8 col-lg-8">
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ old('description', isset($unitmass) ? $unitmass->description : '') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Status')}}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status', isset($unitmass) && $unitmass->status == 'active' ? 'selected' : '') }}>Active</option>
                                    <option value="inactive" {{ old('status', isset($unitmass) && $unitmass->status == 'inactive' ? 'selected' : '') }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($unitmass) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
