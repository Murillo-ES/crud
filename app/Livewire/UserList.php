<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;

    public $searchInput = '';
    public $error = '';

    public $sortAsc = false;

    // Reset pagination when search input is updated
    public function updatedSearchInput()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        if (!empty($this->searchInput)) {
            $query->where('name', 'like', '%' . $this->searchInput . '%');
        }

        if ($this->sortAsc) {
            $query->withCount('products')->orderBy('products_count', 'asc');   
        } else {
            $query->withCount('products')->orderBy('products_count', 'desc');
        }

        $users = $query->paginate(10);

        return view('livewire.user-list', compact('users'));
    }
}
