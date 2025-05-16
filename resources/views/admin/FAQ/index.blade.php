@extends('admin.layouts.layout')

@section('title', 'FAQ')
@section('admin')
@section('pagetitle', __('messages.FAQ'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.FAQ') }}</h4>
                    <div class="d-flex align-items-center">
                        <!-- <form class="d-flex me-2" method="GET" action="{{ route('admin.faq.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form> -->
                    
                        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary btn-sm">+</a>
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped faqList">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('messages.FAQCategoryName') }}</th>
                            <th>{{ __('messages.Question') }}</th>
                            <th>{{ __('messages.Answer') }}</th>
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
    const faqUrl = "{{ route('admin.faq.index') }}";
</script>
