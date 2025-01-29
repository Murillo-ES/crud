<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductAPI extends Controller
{
    public function index()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }

    public function store($name, $price, $description='No description')
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

    public function showById($id)
    {
        $product = Product::where('id', $id)->first();

        return new ProductResource($product);
    }

    public function showByName($name)
    {
        $product = Product::where('name', $name)->first();

        return new ProductResource($product);
    }

    public function showByPrice($price)
    {
        $products = Product::where('price', $price)->get();

        return ProductResource::collection($products);
    }

    public function updateNameById($id, $newName)
    {
        $product = Product::where('id', $id)->first();

            $product->update([
                'name' => $newName
            ]);

        return new ProductResource($product);
    }

    public function updateNameByName($name, $newName)
    {
        $product = Product::where('name', $name)->first();

            $product->update([
                'name' => $newName
            ]);

        return new ProductResource($product);
    }

    public function updateDescriptionById($id, $newDescription)
    {
        $product = Product::where('id', $id)->first();

            $product->update([
                'description' => $newDescription
            ]);

        return new ProductResource($product);
    }

    public function updateDescriptionByName($name, $newDescription)
    {
        $product = Product::where('name', $name)->first();

            $product->update([
                'description' => $newDescription
            ]);

        return new ProductResource($product);
    }

    public function updatePriceById($id, $newPrice)
    {
        $product = Product::where('id', $id)->first();

            $product->update([
                'price' => floatval($newPrice)
            ]);

        return new ProductResource($product);
    }

    public function updatePriceByName($name, $newPrice)
    {
        $product = Product::where('name', $name)->first();

            $product->update([
                'price' => floatval($newPrice)
            ]);

        return new ProductResource($product);
    }

    public function destroyById($id)
    {
        $product = Product::where('id', $id)->first();

        $productId = $product->id;

        $product->delete();

        return response()->json([
            'response' => "Product with ID $productId deleted succesfully!"
        ]);
    }

    public function destroyByName($name)
    {
        $product = Product::where('name', $name)->first();

        $productName = $product->name;

        $product->delete();

        return response()->json([
            'response' => "Product '$productName' deleted succesfully!"
        ]);
    }
}
