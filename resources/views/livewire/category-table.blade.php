<div>
    <div class="mb-3">
        <input type="text" wire:model="search" placeholder="Search categories..." class="form-control" />
    </div>

    <div class="mb-3">
        <select wire:model="statusFilter" class="form-control">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ __('messages.ID') }}</th>
                <th>{{ __('messages.Name') }}</th>
                <th>{{ __('messages.Description') }}</th>
                <th>{{ __('messages.Status') }}</th>
                <th>{{ __('messages.Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ ucfirst($category->status) }}</td>
                <td>
                    {{-- <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="delete({{ $category->id }})"><i class="bi bi-trash3-fill"></i></a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $categories->links() }} <!-- Pagination links -->
    </div>
</div>
