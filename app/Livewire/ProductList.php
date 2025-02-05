<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductList extends Component
{
    use WithPagination;

    #[Url]
    public $sort = 'latest';

    #[Url]
    public $order = 'desc';

    public function orderProducts($sort, $order = null)
    {
        $this->sort = $sort;

        $this->order = $order ?? 'desc';

        $this->resetPage();
    }

    protected $queryString = [
        'sort' => ['except' => 'latest'],
        'order' => ['except' => 'desc'],
    ];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Product::query();

        if ($this->sort == 'latest') {
            $query->latest();
        } elseif ($this->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->orderBy($this->sort, $this->order);
        }

        $products = $query->paginate(10)->withQueryString();

        $emptyProducts = Product::where('stock', '0')->get();

        return view('livewire.product-list', compact('products', 'emptyProducts'));
    }
}
