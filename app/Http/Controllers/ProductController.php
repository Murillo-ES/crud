<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api')->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function indexAPI()
    {
        $products = Product::all();

        return ProductResource::collection($products);
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

    public function storeAPI($name, $price, $description='No description')
    {
        $product = Product::firstOrNew(
            ['name' => $name],
            ['description' => $description, 'price' => floatval($price)]
        );

        if ($product->exists) {
            return response()->json([
                'response' => 'Product already exists.',
                'id' => $product->id
            ]);
        } else {
            $product->save();

            return response()->json([
                'response' => 'Product created succesfully!',
                'id' => $product->id
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function showAPI($id)
    {
        $product = Product::where('id', $id)->first();

        return new ProductResource($product);
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

    public function updateAPI($id, $name = null, $description = null, $price = null)
    {
        // if ($name === null and $description === null and $price === null) {
        //     return response()->json([
        //         'response' => 'No changes made.'
        //     ]);
        // } else {
        //     $product = Product::where('id', $id)->first();

        //     $product->update([
        //         'name' => isset($name) ? $name : $product->name,
        //         'description' => isset($description) ? $description : $product->description,
        //         'price' => isset($price) ? $price : $product->price,
        //     ]);

        //     return new ProductResource($product);
        // }

        $product = Product::where('id', $id)->first();

            $product->update([
                'name' => isset($name) ? $name : $product->name,
                'description' => isset($description) ? $description : $product->description,
                'price' => isset($price) ? $price : $product->price,
            ]);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('Sucesso!', 'Produto removido com sucesso!');
    }

    public function destroyAPI($id)
    {
        $product = Product::where('id', $id)->first();

        $productId = $product->id;

        $product->delete();

        return response()->json([
            'response' => "Product with ID $productId deleted succesfully!"
        ]);
    }
}
