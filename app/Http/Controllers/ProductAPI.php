<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductAPI extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('minPrice')) {
            $products->where('price', '>=', $request->minPrice);
        }

        if ($request->has('maxPrice')) {
            $products->where('price', '<=', $request->maxPrice);
        }

        // MUDAR

        if ($request->has('asc')) {
            $products->orderBy('price');
        }

        if ($request->has('desc')) {
            $products->orderByDesc('price');
        }

        $products = $products->get();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        // MUDAR

        if (!$request->has('name')) {
            return response()->json([
                'message' => 'name variable is required.'
            ]);
        }

        if (!$request->has('price')) {
            return response()->json([
                'message' => 'price variable is required.'
            ]);
        }

        if ($request->price < '0.99') {
            return response()->json([
                'message' => 'price variable must be greater than or equal to 0.99.'
            ]);
        }

        $name = $request->query('name');
        $description = $request->has('description') ? $request->query('description') : 'No description.';
        $price = $request->query('price');

        $product = Product::firstOrNew(
            ['name' => $name],
            ['description' => $description, 'price' => floatval($price)]
        );

        if ($product->exists) {
            return response()->json([
                'response' => 'Product already exists.',
                'id' => $product->id
            ]);
        }

        $product->save();

        return response()->json([
            'response' => 'Product created succesfully!',
            'id' => $product->id
        ]);
    }

    public function update($id, Request $request)
    {
        if(empty($request->query())) {
            return response()->json([
                'message' => "No changes made to product ID #$id."
            ]);
        }

        $targetProduct = Product::where('id', $id)->first();

        // MUDAR

        if ($request->has('newName') && $request->newName != $targetProduct->name) {
            $targetProduct->update([
                'name' => $request->newName
            ]);
        }

        if ($request->has('newDescription') && $request->newDescription != $targetProduct->description) {
            $targetProduct->update([
                'description' => $request->newDescription
            ]);
        }

        if ($request->has('newPrice') && $request->newPrice != $targetProduct->price) {
            $targetProduct->update([
                'price' => $request->newPrice
            ]);
        }

        return response()->json([
            'message' => "Product ID #$id updated succesfully.",
            'updatedProduct' => new ProductResource($targetProduct)
        ]);
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        $product->delete();

        return response()->json([
            'response' => "Product with ID $id deleted succesfully!"
        ]);
    }
}
