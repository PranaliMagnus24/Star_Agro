<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\App\Models\Category;

class CategoryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($query) {
                $query->whereRaw('LOWER(category_name) LIKE ?', ['%' . strtolower($this->search) . '%'])
                      ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($this->search) . '%']);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->paginate(10);

        return view('livewire.category-table', [
            'categories' => $categories,
        ]);
    }
}
