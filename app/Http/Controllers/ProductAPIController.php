<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProductAPIController extends Controller
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

        if ($request->has('sort')) {
            if ($request->sort === 'asc' || $request->sort === 'desc') {
                $products->orderBy('price', $request->sort);
            }
        }

        $products = $products->get();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $data['description'] = $data['description'] ?? 'No description.';
        $data['stock'] = $data['stock'] ?? '1';

        $product = Product::firstOrNew(
            ['name' => $data['name']],
            [
                'description' => $data['description'],
                'price' => floatval($data['price']),
                'stock' => $data['stock']
            ]
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

    public function update($id, ProductRequest $request)
    {
        if(empty($request->query())) {
            return response()->json([
                'message' => "No changes made to product ID #$id."
            ]);
        }

        $targetProduct = Product::where('id', $id)->firstOrFail();

        $targetProduct->update($request->validated());

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
