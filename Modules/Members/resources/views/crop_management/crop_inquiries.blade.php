@extends('members::layouts.master')

@section('title', __('messages.Inquiry'))
@section('pagetitle', __('messages.Inquiry'))
@section('member')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- <form class="d-flex me-2" method="GET" action="#">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form> -->

                        <a href="{{ route('crop.index')}}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped nowrap" id="inquiryTable">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            {{-- <th>{{ __('messages.Farmer Name') }}</th> --}}
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Phone') }}</th>
                            <th>{{ __('messages.Description') }}</th>
                            <th>{{ __('messages.City') }}</th>
                            <!-- <th class="no-wrap">{{ __('messages.Action') }}</th> -->
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
    const inquiryUrl = "{{ route('crop.inquiries', ['id' => $cropManagementId]) }}";
</script>

