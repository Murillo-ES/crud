<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RemoveItem extends Component
{
    public $productId;

    public $quantity;

    public function remove()
    {
        $product = Product::where('id', $this->productId)->firstOrFail();

        $result = $product->onCart - $this->quantity;

        $product->update([
            'onCart' => $result
        ]);

        // Binding cart to user.
        $userId = Auth::user()->id;
        \Cart::session($userId);

        $itemQuantity = \Cart::get($this->productId)->quantity;

        if (($itemQuantity - $this->quantity) == 0) {
            \Cart::remove($this->productId);

            session()->flash('Sucesso!', 'Produto removido com sucesso!');
        } else { 
            \Cart::update($this->productId, array(
                'quantity' => -$this->quantity
            ));

            session()->flash('Sucesso!', 'Quantidade removida com sucesso!');
        }

        return redirect()->route('cart.index');
    }

    public function render()
    {
        return view('livewire.remove-item');
    }
}
