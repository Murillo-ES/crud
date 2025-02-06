<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::paginate(10);

        return view('livewire.user-list', compact('users'));
    }
}
