@extends('admin.layouts.layout')

@section('title', 'Farmer Registration')
@section('admin')
@section('pagetitle', __('messages.Farmer Registration'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Create Farmer Registration</h4>
                    <a href="{{ route('admin.farmer.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="category_id" class="col-md-4 col-lg-3 col-form-label"></label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="phone">

                            </div>

                            <label for="subcategory_id" class="col-md-4 col-lg-3 col-form-label">Sub Category</label>
                            <div class="col-md-8 col-lg-3">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Description</label>
                            <div class="col-md-8 col-lg-8">

                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

