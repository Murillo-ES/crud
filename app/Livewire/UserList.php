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

    public $nameAsc;
    public $sortByName;

    public $dateAsc;
    public $sortByDate;

    public $productsAsc;
    public $sortByProducts;

    // Reset pagination when search input is updated
    public function updatedSearchInput()
    {
        $this->resetPage();
    }

    public function updated($property)
    {
        if ($property === 'nameAsc') {
            $this->sortByName = true;
            $this->reset([
                'dateAsc',
                'sortByDate',
                'productsAsc',
                'sortByProducts'
            ]);

        } elseif ($property === 'dateAsc') {
            $this->sortByDate = true;
            $this->reset([
                'nameAsc',
                'sortByName',
                'productsAsc',
                'sortByProducts'
            ]);
            
        } elseif ($property === 'productsAsc') {
            $this->sortByProducts = true;
            $this->reset([
                'nameAsc',
                'sortByName',
                'dateAsc',
                'sortByDate'
            ]);
        }
    }

    public function render()
    {
        $query = User::query();

        if (!empty($this->searchInput)) {
            $query->where('name', 'like', '%' . $this->searchInput . '%');
        }

        if ($this->sortByName) {
            if ($this->nameAsc) {
                $query->orderBy('name', 'asc');
            } else {
                $query->orderBy('name', 'desc');
            }
        }

        if ($this->sortByDate) {
            if ($this->dateAsc) {
                $query->orderBy('created_at', 'asc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        }

        if ($this->sortByProducts) {
            if ($this->productsAsc) {
                $query->withCount('products')->orderBy('products_count', 'asc');
            } else {
                $query->withCount('products')->orderBy('products_count', 'desc');
            }
        }

        $users = $query->paginate(10);

        return view('livewire.user-list', compact('users'));
    }
}
