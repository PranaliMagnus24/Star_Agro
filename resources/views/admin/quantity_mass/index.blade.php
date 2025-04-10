@extends('admin.layouts.layout')

@section('title', 'Category')
@section('admin')
@section('pagetitle', __('messages.UnitMass'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.UnitMass') }}</h4>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.quantityMass.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    
                        <a href="{{ route('admin.quantityMass.create') }}" class="btn btn-primary btn-sm">+</a>
                        
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                         <th>{{ __('messages.Name') }}</th>
                       
                        <th>{{ __('messages.Description') }}</th>
                        <th>{{ __('messages.Status') }}</th>
                        <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unitMasses as $unitmass)
                        <tr>
                            <td>{{ $unitmass->ID}}</td>
                            <td>{{ ucfirst($unitmass->name) }}</td>
                            <td>{{ $unitmass->description }}</td>
                            <td>{{ ucfirst($unitmass->status) }}</td>

                            <td class="text-center text-nowrap">
                            <a href="{{ route('admin.quantityMass.edit', $unitmass->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                            
                              
                              <!-- <a href="{{ route('admin.quantityMass.delete', $unitmass->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a> -->
                              <form action="{{ route('admin.quantityMass.delete', $unitmass->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                  {{ $unitMasses->links() }}

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
