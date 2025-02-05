<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    #[Validate('required', message: 'Defina um nome para o seu produto.')]
    #[Validate('string')]
    #[Validate('max:255', message: 'O nome do seu produto é muito grande.')]
    public $name = '';

    public $description = '';

    #[Validate('required', message: 'Defina um preço para o seu produto.')]
    #[Validate('numeric', message: 'Valor inválido.')]
    #[Validate('min:0.99', message: 'Valor mínimo para o produto é R$ 0,99.')]
    #[Validate('max:999.99', message: 'Valor máximo para o produto é R$ 999,99.')]
    public $price = '';

    #[Validate('required', message: 'Defina uma quantidade para o seu produto.')]
    #[Validate('numeric', message: 'Valor inválido.')]
    #[Validate('min:1', message: 'Mínimo de 1 unidade necessária para criar o produto.')]
    #[Validate('max:999', message: 'Máximo de 999 unidades necessárias para criar o produto.')]
    public $stock = '';

    public function create()
    {
        $this->validate();

        Product::create([
            'name' => Str::ucfirst($this->name),
            'description' => empty($this->description) ? 'No description.' : Str::ucfirst($this->description),
            'price' => floatval($this->price),
            'stock' => $this->stock
        ]);

        return redirect()->route('products.index')->with('Sucesso!', 'Produto criado com sucesso!');
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
