@extends('admin.layouts.layout')

@section('title', 'Trader')
@section('admin')
@section('pagetitle', __('messages.Trader'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Trader') }}</h4>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.trader.index') }}">
                            <div class="input-group">
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
                                    <td>
                                        @if ($user->farmerDocuments->count())
                                            <button class="btn btn-link" data-bs-toggle="modal"
                                                data-bs-target="#documentModal{{ $user->id }}">
                                                {{ __('messages.View Document') }}
                                            </button>

                                            <div class="modal fade" id="documentModal{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="documentModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="documentModalLabel{{ $user->id }}">
                                                                {{ __('messages.All Documents') }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($user->farmerDocuments as $document)
                                                                @if ($document->file_path)
                                                                    <p><strong>Document:</strong></p>
                                                                    <img
                                                                        src="{{ asset( $document->file_path) }}"
                                                                        style="width: 226px; height: 158px;"
class="mb-4"></img>
                                                                    <!-- <p>
                                                                        <strong>Status:</strong>
                                                                        @if ($document->is_verified)
                                                                            <span class="text-success fw-bold">{{ __('messages.Verified') }}</span>
                                                                        @else
                                                                            <span class="text-danger fw-bold">{{ __('messages.Not Verified') }}</span>
                                                                        @endif
                                                                    </p> -->
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <!-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                                                        </div> -->
                                                        <div class="modal-footer">
                                                            @if ($document->is_verified)
                                                                <button type="button" class="btn btn-success" disabled>
                                                                    <i class="bi bi-check2-circle"></i>
                                                                    {{ __('messages.Verified') }}
                                                                </button>
                                                            @else
                                                                <form
                                                                    action="{{ route('admin.verify.document', $document->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-danger">
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

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
