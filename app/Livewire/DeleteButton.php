<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class DeleteButton extends Component
{
    public $productId;

    public function delete()
    {
        $product = Product::find($this->productId);

        if ($product) {
            if ($product->onCart > 0) {
                session()->flash('Falha na operação!', 'Esse produto se encontra no carrinho de um usuário!');

                return redirect()->route('products.show', $this->productId);
            }

            $product->delete();

            session()->flash('Sucesso!', 'Produto removido com sucesso!');
        }

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.delete-button');
    }
}
