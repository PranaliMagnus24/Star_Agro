@extends('admin.layouts.layout')

@section('title', 'FAQ')
@section('admin')
@section('pagetitle', __('messages.FAQ'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($faq) ? 'Edit' : 'Create' }}</h4>
                    <a href="{{ route('admin.faq.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-skip-backward-fill"></i>
                    </a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($faq) ? route('admin.faq.update', $faq->id) : route('admin.faq.store') }}" method="POST">
                        @csrf
                        @if(isset($faq))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="question" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Question')}}</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question ?? '') }}">
                                @error('question')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="answer" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Answer')}}</label>
                            <div class="col-md-8 col-lg-8">
                                <textarea name="answer" id="answer" cols="30" rows="3" class="form-control">{{ old('answer', $faq->answer ?? '') }}</textarea>
                                @error('answer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Status')}}</label>
                            <div class="col-md-8 col-lg-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status', $faq->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $faq->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($faq) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
