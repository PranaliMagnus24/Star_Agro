@extends('admin.layouts.layout')
@section('title', 'Edit CMS Page')
@section('admin')
@section('pagetitle', __('messages.Edit CMS Page'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit CMS Page</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pages.update', $page->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">URL</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary', $page->summary) }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                            <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area" placeholder="Write here">{{ isset($page) ? $page->description: old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if($page->image)
                                <div class="mb-2">
                                    <img src="{{ asset('upload/pages/' . $page->image) }}" alt="Image" style="width: 100px; height: auto; border-radius: 5px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metaTitle" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="metaKeyword" class="form-label">Meta Keyword</label>
                            <input type="text" class="form-control" id="metaKeyword" name="meta_keyword" value="{{ old('meta_keyword', $page->meta_keyword) }}">
                        </div>

                        <div class="mb-3">
                            <label for="metaDescription" class="form-label">Meta Description</label>
                            <!-- <textarea class="form-control" id="metaDescription" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea> -->
                            <div id="quill-meta-description" class="quill-editor" style="height: 100px;"></div>
                            <textarea rows="3" class="mb-3 d-none" name="meta_description" id="quill-editor-area" placeholder="Write here">{{ isset($page) ? $page->meta_description: old('meta_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ogTitle" class="form-label">OG Title</label>
                            <input type="text" class="form-control" id="ogTitle" name="og_title" value="{{ old('og_title', $page->og_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="ogDescription" class="form-label">OG Description</label>
                            <!-- <textarea class="form-control" id="ogDescription" name="og_description" rows="3">{{ old('og_description', $page->og_description) }}</textarea> -->
                            <div id="quill-meta-description" class="quill-editor" style="height: 100px;"></div>
                            <textarea rows="3" class="mb-3 d-none" name="og_description" id="quill-editor-area" placeholder="Write here">{{ isset($page) ? $page->og_description: old('og_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ogImage" class="form-label">OG Image</label>
                            @if($page->og_img)
                                <div class="mb-2">
                                    <img src="{{ asset('upload/pages/' . $page->og_img) }}" alt="OG Image" style="width: 100px; height: auto; border-radius: 5px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="ogImage" name="og_img">
                            @error('og_img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active" {{ (old('status', $page->status) == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ (old('status', $page->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                <option value="draft" {{ (old('status', $page->status) == 'draft') ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                Update Page
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
   

    //text editor script
    document.addEventListener('DOMContentLoaded', function () {
    const editors = document.querySelectorAll('[id^="quill-editor-area"]');
    editors.forEach((textarea, index) => {
        const quillEditorId = `quill-editor-${index}`;
        const quillContainer = textarea.previousElementSibling;
        quillContainer.id = quillEditorId;
        const editor = new Quill(`#${quillEditorId}`, {
            theme: 'snow',
        });
        editor.root.innerHTML = textarea.value;
        editor.on('text-change', function () {
            textarea.value = editor.root.innerHTML;
        });
        textarea.addEventListener('input', function () {
            editor.root.innerHTML = textarea.value;
        });
    });
});
</script>
