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
