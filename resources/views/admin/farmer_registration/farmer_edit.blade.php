@extends('admin.layouts.layout')

@section('title', 'Edit Farmer')
@section('admin')
@section('pagetitle', __('messages.Edit Farmer'))

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4>{{ __('messages.Edit Farmer') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.farmer.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('messages.Phone') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="solar_dryer" class="form-label">{{ __('messages.Solar Dryer') }}</label>
                            <select class="form-select" name="solar_dryer" id="solar_dryer" required>
                                <option value="yes" {{ $user->solar_dryer == 'yes' ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                                <option value="no" {{ $user->solar_dryer == 'no' ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <!-- <label for="documents" class="form-label">{{ __('messages.Documents') }}</label>
                            <input type="file" class="form-control" name="documents" id="documents"> -->
                            <label for="documents" class="form-label">{{ __('messages.Documents') }}</label>
                            <input type="file" class="form-control" name="documents[]" id="documents" multiple>
                            <!-- @if ($user->documents)
                                <p class="mt-2"><a href="{{ asset('uploads/farmers/' . $user->documents) }}" target="_blank">{{ __('messages.View Document') }}</a></p>
                            @endif -->
                            @if ($user->farmerDocuments && $user->farmerDocuments->count())
    <div class="mt-3 d-flex flex-wrap gap-3">
        @foreach ($user->farmerDocuments as $index => $document)
            @if ($document->file_path)
                <!-- Trigger Button -->
                <button type="button" class="btn p-0 border-0" data-bs-toggle="modal" data-bs-target="#docModal{{ $user->id }}{{ $index }}">
                    <img src="{{ asset('upload/farmer_documents/' . $user->id . '/' . $document->file_path) }}" alt="Document" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                </button>

                <!-- Modal -->
                <div class="modal fade" id="docModal{{ $user->id }}{{ $index }}" tabindex="-1" aria-labelledby="docModalLabel{{ $user->id }}{{ $index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="docModalLabel{{ $user->id }}{{ $index }}">{{ __('messages.Document') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('upload/farmer_documents/' . $user->id . '/' . $document->file_path) }}" alt="Full Document" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif


                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.Update') }}</button>
                        <a href="{{ route('admin.farmer.index') }}" class="btn btn-secondary">{{ __('messages.Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
