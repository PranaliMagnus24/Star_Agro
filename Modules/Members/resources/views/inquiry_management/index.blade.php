@extends('members::layouts.master')

@section('title', __('messages.My Inquiry'))
@section('pagetitle', __('messages.My Inquiry'))
@section('member')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <!-- Search and Title -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- <form class="d-flex" method="GET" action="#">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary" title="Search">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form> -->
                </div>

                <!-- Inquiry List -->
                <table id="inquiriesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CropName</th>
                            <th>FarmerName</th>
                            <th>Mobile</th>
                            <th>Email</th> 
                            <th>City</th>
                            <th>Date</th>
                            <th>Wallet Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

               
            </div>
        </div>
    </div>

@endsection
<script>
    const myinquiriesUrl= "{{ route('member.inquiries') }}";
</script>
