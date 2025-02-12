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

        $users = $query->paginate(10);

        return view('livewire.user-list', compact('users'));
    }
}
