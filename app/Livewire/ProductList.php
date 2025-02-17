<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
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

    #[Validate('numeric', message: 'Valor inválido.')]
    public $minPrice;

    #[Validate('numeric', message: 'Valor inválido.')]
    public $maxPrice;

    public function valueFilter()
    {
        $this->resetPage();
    }

    public function orderProducts($sort, $order = null)
    {
        $this->sort = $sort;

        $this->order = $order ?? 'desc';

        $this->resetPage();
    }

    protected $queryString = [
        'sort' => ['except' => 'latest'],
        'order' => ['except' => 'desc'],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
    ];

    public function render()
    {
        $query = Product::query();

        if ($this->minPrice != '') {
            $query->where('price', '>', $this->minPrice);
        }

        if ($this->maxPrice != '') {
            $query->where('price', '<', $this->maxPrice);
        }

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
