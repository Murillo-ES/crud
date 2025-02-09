<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    // Cart List
    public function index()
    {
        $items = \Cart::getContent();
        
        return view('cart.index', compact('items'));
    }

    // Add product to cart.
    public function addProduct(Request $request)
    {
        // Check if user inputted a valid quantity before proceeding.
        if (empty($request->quantity)) {
            return redirect()->route('products.show', $request->id)->with('caution', 'Selecione uma quantidade válida para adicionar ao carrinho.');
        }

        $product = Product::where('id', $request->id)->firstOrFail();

        $quantityOnCart = $product->onCart;
        $quantityOnStock = $product->stock;
        
        $totalQuantity = $quantityOnCart + $request->quantity;

        // Check if it's possible to buy the intended quantity.
        if ($totalQuantity > $quantityOnStock) {
            return redirect()->route('products.show', $request->id)->with(
                "Falha na operação!",
                "Não temos esta quantidade do produto escolhido em estoque. Verifique seu carrinho e tente novamente!"
            );
        }

        $product->update([
            'onCart' => $product->onCart + $request->quantity
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

    // Remove all items from cart.
    public function clear(Request $request)
    {
        // Check if the cart is empty before proceeding.
        if (\Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('caution', 'Você não tem itens em seu carrinho no momento!');
        }

        $idArray = $request->idArray;

        foreach ($idArray as $id) {
            $product = Product::where('id', $id)->firstOrFail();

            $product->update([
                'onCart' => 0
            ]);
        }

        \Cart::clear();

        return redirect()->route('cart.index')->with('Sucesso!', "Carrinho esvaziado com sucesso!");
    }

    // Finish purchase, removing all items from cart and deducting them from the database.

    // If a fully functional payment system was available, it would be inserted either here, or on a
    // separate code, confirming payment BEFORE deducting the product(s).
    public function checkout(Request $request)
    {
        $cartContent = \Cart::getContent();

        // Check if the cart is empty before proceeding.
        if (\Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('caution', 'Você não tem itens em seu carrinho no momento!');
        } 
            
        $idArray = $request->idArray;

        foreach ($idArray as $id) {
            $product = Product::where('id', $id)->firstOrFail();

            $product->update([
                'stock' => $product->stock - $product->onCart,
                'onCart' => 0
            ]);
        }

        \Cart::clear();

        return redirect()->route('cart.index')->with('Sucesso!', "Compra concluída com sucesso!");
    }
}
