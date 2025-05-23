@extends('admin.layouts.layout')

@section('title', __('messages.Category'))
@section('admin')
@section('pagetitle', __('messages.Category'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($category) ? __('messages.Edit_Category') : __('messages.Create_Category') }}</h4>
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="parent_id" id="parent_id">
                        <input type="hidden" name="subcategory_id" id="hdnsubcategory_id">

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Title') }}</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="category_name" id="title" class="form-control" value="{{ old('category_name', isset($category) ? $category->category_name : '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Category') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">{{ __('messages.Select_Category') }}</option>
                                    @foreach($categories as $cat)
                                        @if($cat->parent_id == 0)
                                            <option value="{{ $cat->id }}" {{ old('category_id', isset($category) && $category->parent_id == $cat->id && $category->subcategory_id == 0 ? 'selected' : '') }}>
                                                {{ $cat->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('category_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <label for="subcategory_id" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Sub_Category') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">{{ __('messages.Select_Subcategory') }}</option>
                                    @foreach($categories as $subcat)
                                        @if($subcat->parent_id > 0 && $subcat->subcategory_id == 0)
                                            <option value="{{ $subcat->id }}" data-parent="{{ $subcat->parent_id }}" {{ old('subcategory_id', isset($category) && $category->subcategory_id == $subcat->id ? 'selected' : '') }}>
                                                {{ $subcat->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Category_Image') }}</label>
                            <div class="col-md-8 col-lg-3">
                                @if(isset($category) && $category->category_image)
                                    <img src="{{ asset($category->category_image) }}" alt="Category Image" width="100" class="mb-2">
                                @endif
                                <input type="file" class="form-control" name="category_image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Description') }}</label>
                            <div class="col-md-8 col-lg-8">
                                <textarea name="description" id="desc" cols="30" rows="5" class="form-control">{{ isset($category) ? $category->description : '' }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Status') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ (isset($category) && $category->status == 'active') ? 'selected' : '' }}>{{ __('messages.Active') }}</option>
                                    <option value="inactive" {{ (isset($category) && $category->status == 'inactive') ? 'selected' : '' }}>{{ __('messages.Inactive') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                                {{ isset($category) ? __('messages.Update') : __('messages.Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Add JS if needed
</script>
