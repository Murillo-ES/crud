<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProductAPIController extends Controller
{
    // Return products list.
    public function index(Request $request)
    {
        $products = Product::query();

        // Optional sorting via query strings.
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

    // Return specific product by ID.
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        return new ProductResource($product);
    }

    // Create new product.
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $data['description'] = $data['description'] ?? 'No description.';
        $data['stock'] = $data['stock'] ?? '1';

        $product = Product::firstOrNew(
            ['name' => $data['name']],
            [
                'user_id' => Auth::user()->id,
                'description' => $data['description'],
                'price' => floatval($data['price']),
                'stock' => $data['stock']
            ]
        );

        // Check if product's name is already on the database before proceeding.
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

    // Edit products information by ID.
    public function update($id, ProductRequest $request)
    {
        // Check if any changes were made via query strings.
        if(empty($request->query())) {
            return response()->json([
                'response' => "No changes made to product ID #$id."
            ]);
        }

        // Check if the new name already exists on the database before proceeding.
        if($request->has('name') && Product::where('name', $request->name)->exists()){
            return response()->json([
                'response' => "This product's name already exists on the database.",
                'id' => Product::where('name', $request->name)->value('id')
            ]);
        }

        $targetProduct = Product::where('id', $id)->firstOrFail();

        // Check if product belongs to the user.
        if (!($targetProduct->user_id == Auth::user()->id)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $targetProduct->update($request->validated());

        return response()->json([
            'response' => "Product ID #$id updated succesfully.",
            'updatedProduct' => new ProductResource($targetProduct)
        ]);
    }

    // Delete product from the database by ID.
    public function destroy($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        $product->delete();

        return response()->json([
            'response' => "Product with ID $id deleted succesfully!"
        ]);
    }
}
