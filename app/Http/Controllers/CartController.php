<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    public function index()
    {
        $items = \Cart::getContent();
        
        return view('cart.index', compact('items'));
    }

    public function addProduct(Request $request)
    {
        if (empty($request->quantity)) {
            return redirect()->route('products.show', $request->id)->with('caution', 'Selecione uma quantidade válida para adicionar ao carrinho.');
        }

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

    public function clear(Request $request)
    {
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

    public function checkout(Request $request)
    {
        $cartContent = \Cart::getContent();

        if (\Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('caution', 'Você não tem itens em seu carrinho no momento!');
        } 
            
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

    public function exportToPDF()
    {
        $cartCollection = \Cart::getContent();

        $pdf = Pdf::loadView('pdf.cart', compact('cartCollection'));

        return $pdf->download('cart.pdf');
    }
}
