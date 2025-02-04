<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Product;

class ProductList extends Component
{
    public $products;

    #[Url]
    public $sort = '';

    #[Url]
    public $order = '';

    public function mount()
    {
        $this->products = Product::all();
    }

    public function orderProducts($sort, $order = null)
    {
        $this->sort = $sort;

        $this->order = $order ?? '';

        $query = Product::query();

        if ($sort == 'latest') {
            $query->latest();
        } elseif ($sort == 'oldest') {
            $query->oldest();
        } else {
            $query->orderBy($sort, $order);
        }

        $this->products = $query->get();
    }

    protected $queryString = [
        'sort' => ['except' => ''],
        'order' => ['except' => '']
    ];

    public function render()
    {
        return view('livewire.product-list');
    }
}
