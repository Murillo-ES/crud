<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([
            'name' => Str::title($request->input('name')),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock')
        ]);

        return redirect()->route('products.index')->with('Sucesso!', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect()->route('products.index')->with('Sucesso!', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('Sucesso!', 'Produto removido com sucesso!');
    }

    public function exportToCSV()
    {
        return response()->streamDownload(function(){
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['ID', 'Name', 'Description', 'Price', 'Stock']);

            $productsList = Product::select(['id', 'name', 'description', 'price', 'stock'])->get();

            foreach ($productsList as $product) {
                fputcsv($handle, $product->toArray());
            }

            fclose($handle);
        },  'products.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}