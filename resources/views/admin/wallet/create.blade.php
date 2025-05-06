@extends('admin.layouts.layout')

@section('title', 'Wallet')
@section('admin')
@section('pagetitle', __('messages.Create Wallet'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Create Wallet') }}</h4>
                    <a href="{{ route('admin.wallet.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-skip-backward-fill"></i>
                    </a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('wallet.store') }}" method="POST">
                        
                        @csrf

                        <div class="row mb-3">
                            <label for="holder_type" class="col-md-4 col-lg-3 col-form-label">Holder Type</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="holder_type" id="holder_type" class="form-control" required>
                                @error('holder_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="holder_id" class="col-md-4 col-lg-3 col-form-label">Holder ID</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="number" name="holder_id" id="holder_id" class="form-control" required>
                                @error('holder_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slug" class="col-md-4 col-lg-3 col-form-label">Slug</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="slug" id="slug" class="form-control" required>
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="uuid" class="col-md-4 col-lg-3 col-form-label">UUID</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="uuid" id="uuid" class="form-control" required>
                                @error('uuid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="description" id="description" class="form-control">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="meta" class="col-md-4 col-lg-3 col-form-label">Meta (JSON)</label>
                            <div class="col-md-8 col-lg-8">
                                <textarea name="meta" id="meta" rows="3" class="form-control" placeholder='{"key":"value"}'></textarea>
                                @error('meta')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="balance" class="col-md-4 col-lg-3 col-form-label">Balance</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="number" name="balance" id="balance" class="form-control" value="0" required>
                                @error('balance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="decimal_places" class="col-md-4 col-lg-3 col-form-label">Decimal Places</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="number" name="decimal_places" id="decimal_places" class="form-control" value="2" required>
                                @error('decimal_places')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
