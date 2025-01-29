<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $name = Str::title($request->input('name'));
        $description = $request->input('description');
        $price = $request->input('price');

        Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price
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
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;

        $product->update([
            'name' => $name,
            'description' => $description,
            'price' => $price
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
}
