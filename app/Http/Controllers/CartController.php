<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $items = \Cart::getContent();
        
        return view('cart.index', compact('items'));
    }

    public function addProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();

        $product->update([
            'stock' => $product->stock - $request->quantity
        ]);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'description' => $product->description
            )
        ]);

        return redirect()->route('products.show', $request->id)->with('Sucesso!', "Produto adicionado ao carrinho!");
    }

    public function removeProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();

        $product->update([
            'stock' => $product->stock + $request->quantity
        ]);

        $itemQuantity = \Cart::get($request->id)->quantity;

        if (($itemQuantity - $request->quantity) == 0) {
            \Cart::remove($request->id);
        } else { 
            \Cart::update($request->id, array(
                'quantity' => -$request->quantity
            ));
        }

        return redirect()->route('cart.index')->with('Sucesso!', "Carrinho atualizado com sucesso!");
    }
}
