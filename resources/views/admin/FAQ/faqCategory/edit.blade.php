@extends('admin.layouts.layout')

@section('title', 'Edit FAQ Category')
@section('admin')
@section('pagetitle', __('messages.Edit FAQ Category'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Edit FAQ Category') }}</h4>
                
                    <a href="{{ route('admin.faqCategory') }}" class="btn btn-primary btn-sm">

                        <i class="bi bi-skip-backward-fill"></i>
                    </a>
                </div>
                <div class="card-body mt-3">
                <form action="{{ route('admin.faq.faqCategory.update', $category->id) }}" method="POST">
                @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.FAQCategoryName') }}</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Description') }}</label>
                            <div class="col-md-8 col-lg-8">
                                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Status') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>{{ __('messages.Active') }}</option>
                                    <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>{{ __('messages.Inactive') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection