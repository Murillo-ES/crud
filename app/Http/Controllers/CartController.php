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

        $quantityOnCart = $product->onCart;
        $quantityOnStock = $product->stock;
        
        $totalQuantity = $quantityOnCart + $request->quantity;

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

    public function removeProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();

        $product->update([
            'onCart' => $product->onCart - $request->quantity
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

    public function clear(Request $request)
    {
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

    public function checkout(Request $request)
    {
        $idArray = $request->idArray;

        foreach ($idArray as $id) {
            $product = Product::where('id', $id)->firstOrFail();

            // IF MULTIPLE USERS ARE BUYING PRODUCTS
            
            // if ($product->stock < $product->onCart) {
            //     return redirect()->route('cart.index')->with('Falha na operação!', "Não temos esta quantidade disponível para o produto $product->name.");
            // }

            $product->update([
                'stock' => $product->stock - $product->onCart,
                'onCart' => 0
            ]);
        }

        \Cart::clear();

        return redirect()->route('cart.index')->with('Sucesso!', "Compra concluída com sucesso!");
    }

    public function exportToCSV()
    {
        return response()->streamDownload(function(){
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['ID', 'Name', 'Description', 'Price', 'Quantity']);

            $cartCollection = \Cart::getContent();

            foreach ($cartCollection as $item) {
                $itemInfo = [
                    $item->id,
                    $item->name,
                    $item->attributes->description,
                    $item->price,
                    $item->quantity
                ];

                fputcsv($handle, $itemInfo);
            }

            fclose($handle);
        },  'cart.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
