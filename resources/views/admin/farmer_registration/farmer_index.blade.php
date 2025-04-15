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
                                    <option value="yes" {{ request('solar_dryer') == 'yes' ? 'selected' : '' }}>
                                        {{ __('messages.Yes') }}</option>
                                    <option value="no" {{ request('solar_dryer') == 'no' ? 'selected' : '' }}>
                                        {{ __('messages.No') }}</option>
                                </select>


                                <input type="text" name="search" class="form-control" placeholder="Search"
                                    value="{{ request('search') }}">
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
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ ucfirst($user->solar_dryer) }}</td>
                                    <td>
                                        @if (!empty($user->farmerDocuments) && $user->farmerDocuments->count())
                                            @foreach ($user->farmerDocuments as $document)
                                                @if ($document->file_path)
                                                    <button class="btn btn-link" data-bs-toggle="modal"
                                                        data-bs-target="#documentModal{{ $user->id }}{{ $loop->index }}">
                                                        {{ __('messages.View Document') }}
                                                    </button>


                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="documentModal{{ $user->id }}{{ $loop->index }}"
                                                        tabindex="-1" aria-labelledby="documentModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="documentModalLabel">
                                                                        {{ __('messages.Document') }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <iframe
                                                                        src="{{ asset('upload/farmer_documents/' . $user->id . '/' . $document->file_path) }}"
                                                                        style="width: 100%; height: 400px;"
                                                                        frameborder="0"></iframe>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if ($document->is_verified)
                                                                        <button type="button" class="btn btn-success"
                                                                            disabled>
                                                                            <i class="bi bi-check2-circle"></i>
                                                                            {{ __('messages.Verified') }}
                                                                        </button>
                                                                    @else
                                                                        <form
                                                                            action="{{ route('admin.verify.document', $document->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">
                                                                                <i class="bi bi-check2-circle"></i>
                                                                                {{ __('messages.Verify Document') }}
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                @else
                                                <span>{{ __('messages.No Document available') }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                        <span>{{ __('messages.No Document available') }}</span>
                                        @endif
                                    </td>

                                    <td class="text-center text-nowrap">
                                        @if (!empty($user->farmerDocuments) && $user->farmerDocuments->count())
                                            @php $showedAction = false; @endphp
                                            @foreach ($user->farmerDocuments as $document)
                                                @if ($document->file_path && !$showedAction)
                                                    <form action="{{ route('admin.verify.document', $document->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $document->is_verified ? 'btn-success' : 'btn-danger' }}"
                                                            title="{{ $document->is_verified ? 'Verified' : 'Verify Document' }}">
                                                            <i class="bi bi-check2-circle"></i>
                                                        </button>
                                                    </form>
                                                    @php $showedAction = true; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <!-- <a href="{{ route('admin.farmer.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('admin.farmer.delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                    </form> -->

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
