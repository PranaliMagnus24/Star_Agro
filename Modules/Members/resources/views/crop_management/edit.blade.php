@extends('members::layouts.master')

@section('title', __('messages.Crop Management'))
@section('pagetitle', __('messages.Crop Management'))
@section('member')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('crop.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('crop.management.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="farmer_id" id="farmer_id" value="{{ Auth::id() }}">
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Category') }} <span class="text-danger">*</span></label>
                            <div class="col-md-3 col-lg-3">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">--Select Category--</option>
                                    @foreach($categories as $cat)
                                        @if($cat->parent_id == 0)
                                            <option value="{{ $cat->id }}"
                                                {{ $data->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <label for="" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Subcategory') }}<span class="text-danger">*</span></label>
                            <div class="col-md-3 col-lg-3">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">-- Select Subcategory --</option>
                                    @foreach($categories as $subcat)
                                        @if($subcat->parent_id > 0 && $subcat->subcategory_id == 0)
                                            <option value="{{ $subcat->id }}"
                                                {{ $data->subcategory_id == $subcat->id ? 'selected' : '' }}>
                                                {{ $subcat->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="crop_id" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Crop Name') }} <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-3">
                                <select name="crop_id" id="crop_id" class="form-control">
                                    <option value="">-- Select Crop Name --</option>
                                    @foreach($categories as $crop)
                                        @if($crop->parent_id > 0 && $crop->subcategory_id > 0)
                                            <option value="{{ $crop->id }}"
                                                {{ $data->crop_id == $crop->id ? 'selected' : '' }}>
                                                {{ $crop->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('crop_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <label for="planating_date" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Planting crops date') }} <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-3">
                                <input type="date" name="planating_date" class="form-control" id="planating_date" value="{{ old('planating_date', $data->planating_date) }}">
                                @error('planating_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harvesting_start_date" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Harvesting start date') }} <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-3">
                                <input type="date" name="harvesting_start_date" class="form-control" id="harvesting_start_date" value="{{ old('harvesting_start_date', $data->harvesting_start_date) }}">
                                @error('harvesting_start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <label for="harvesting_end_date" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Harvesting end date') }} <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-3">
                                <input type="date" name="harvesting_end_date" id="harvesting_end_date" class="form-control" value="{{ old('harvesting_end_date', $data->harvesting_end_date) }}">
                                @error('harvesting_end_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="expected_price" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Expected Price') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="expected_price" id="expected_price" class="form-control" value="{{ old('expected_price', $data->expected_price) }}">
                            </div>
                            @error('expected_price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="min_qty" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Min Quantity') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="min_qty" id="min_qty" class="form-control" value="{{ old('min_qty', $data->min_qty) }}">
                            </div>
                            @error('min_qty')
                                <span class="text-danger">{{$message}}</span>
                            @enderror

                            <label for="max_qty" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Max Quantity') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="max_qty" id="max_qty" class="form-control" value="{{ old('max_qty', $data->max_qty) }}">
                            </div>
                            @error('max_qty')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Type') }} <span class="text-danger">*</span></div>
                            <div class="col-md-8 col-lg-3 d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="crop_type" id="is_organic" value="organic" {{ $data->type == 'organic' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_organic">{{ __('messages.Organic') }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="crop_type" id="is_inorganic" value="inorganic" {{ $data->type == 'inorganic' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_inorganic">{{ __('messages.Inorganic') }}</label>
                                </div>
                            </div>

                            <label for="crop_images" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Upload Photo') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="file" name="crop_images[]" id="crop_images" class="form-control" multiple>
                                @php
                                $images = $data->crop_images ? json_decode($data->crop_images, true) : [];
                                @endphp

                                @if (!empty($images) && is_array($images))
                                    @foreach ($images as $image)
                                        <img src="{{ asset($image) }}" alt="Selected Image" width="100" class="mt-2">
                                    @endforeach
                                @endif
                                @error('crop_images')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="upload_video" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Upload Video') }}</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="file" class="form-control" name="crop_video" id="upload_video">
                                @if($data->crop_video)
                                    <video width="200" controls class="mt-2">
                                        <source src="{{ asset($data->crop_video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                            @error('crop_video')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Description') }}</label>
                            <div class="col-md-8 col-lg-9">
                               <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description', $data->description) }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Status') }} <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-3">
                               <select name="status" id="status" class="form-control">
                                <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                               </select>
                               @error('status')
                               <span class="text-danger">{{$message}}</span>
                           @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            $('#subcategory_id').empty().append('<option value="">--Select Sub Category--</option>');
            $('#crop_id').empty().append('<option value="">--Select Crop Name--</option>');

            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#subcategory_id').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                        });
                    }
                });
            }
        });

        $('#subcategory_id').change(function() {
            var subcategoryId = $(this).val();
            $('#crop_id').empty().append('<option value="">--Select Crop Name--</option>');

            if (subcategoryId) {
                $.ajax({
                    url: '/get-crops/' + subcategoryId,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#crop_id').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
