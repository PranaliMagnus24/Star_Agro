@extends('admin.layouts.layout')

@section('title', 'District')
@section('admin')
@section('pagetitle', __('messages.District'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.District') }}</h4>
                    <div class="d-flex align-items-center">
                      
                        <a href="{{ route('districts.create') }}" class="btn btn-primary btn-sm">+</a>
                        
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped" id="districtsTable">
                        <thead>
                            <tr>
                                 <th>{{ __('messages.ID') }}</th>
                               
                                
                                <th>{{ __('messages.District') }}</th>
                                 <th>{{__('messages.State') }}</th>
                                 <th>{{ __('messages.Code') }}</th>
                                <th>{{ __('messages.Status') }}</th>
                                <th class="no-wrap">{{ __('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    const districtUrl = "{{ route('districts.index') }}";
</script>
