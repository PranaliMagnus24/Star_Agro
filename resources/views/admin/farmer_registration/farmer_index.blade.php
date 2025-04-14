@extends('admin.layouts.layout')

@section('title', 'Farmers')
@section('admin')
@section('pagetitle', __('messages.Farmers'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- <h4 class="mb-0">{{ __('messages.Farmers') }}</h4>  -->
                    <h4 class="mb-0">
    {{ __('messages.Farmers') }} 
    <span class="badge bg-success ms-2">{{ $yesCount }}</span>
</h4>

                    <div class="d-flex align-items-center">
                    
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.farmer.index') }}">
                            <div class="input-group">
                                <select name="solar_dryer" class="form-select me-2">
                                    <option value="">{{ __('messages.All') }}</option>
                                    <option value="yes" {{ request('solar_dryer') == 'yes' ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                                    <option value="no" {{ request('solar_dryer') == 'no' ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                                </select> 


                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Phone') }}</th>
                            <th>{{ __('messages.Solar Dryer') }}</th>
                            <th>{{ __('messages.Documents') }}</th>
                            <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{ ucfirst($user->solar_dryer)}}</td>
                            <td>
                                @if (!empty($user->farmerDocuments) && $user->farmerDocuments->count())
                                    @foreach ($user->farmerDocuments as $document)
                                @if ($document->file_path)
                                <a href="{{ asset('upload/farmer_documents/' . $user->id . '/' . $document->file_path) }}" target="_blank">
                                    <img src="{{ asset('upload/farmer_documents/' . $user->id . '/' . $document->file_path) }}" alt="Document" style="max-width: 50px; max-height: 50px; border: 1px solid #ddd; padding: 2px;">
                                </a>
                                 @else
                                     <span>No Document</span>
                                 @endif
                                    @endforeach
                                @else
                                  <span>No Document</span>
                                @endif
                            </td>
                        
                            
                            <td class="text-center text-nowrap">
                            <form action="{{ route('admin.verify.document', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                     @method('PATCH')
                                   <button type="submit" class="btn btn-info btn-sm" title="Verify Document">
                                   <i class="bi bi-check2-circle"></i>
                                    </button>
                            </form>
                                 <a href="{{ route('admin.farmer.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('admin.farmer.delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                  </table>
                  <div class="d-flex justify-content-center">
                    {{ $users->appends(request()->query())->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
