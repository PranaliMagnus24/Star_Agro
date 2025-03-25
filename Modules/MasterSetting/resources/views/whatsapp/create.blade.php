@extends('admin.layouts.layout')

@section('title', 'Whatsapp')
@section('admin')
@section('pagetitle', __('messages.Whatsapp'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($whatsapp) ? __('messages.Edit') : __('messages.Add') }}</h4>
                    <a href="{{ route('whatsapp.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($whatsapp) ? route('whatsapp.update', $whatsapp->id) : route('whatsapp.store') }}" method="POST">
                        @csrf
                        @if(isset($whatsapp))
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Api Key</label>
                            <div class="col-md-8 col-lg-6">
                                <input type="text" name="api_key" id="api_key" class="form-control" value="{{ isset($whatsapp) ? $whatsapp->api_key : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">
                               <select name="status" id="status" class="form-control">
                                <option value="active" {{ (isset($whatsapp) && $whatsapp->status == 'active') ? 'selected' : 'selected' }}>Active</option>
                                <option value="inactive" {{ (isset($whatsapp) && $whatsapp->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                               </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($whatsapp) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

