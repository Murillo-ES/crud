<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('caution', 'Somente usuários cadastrados podem criar produtos. Faça login ou cadastre-se!');
        }

        $userId = Auth::user()->id;

        return view('products.create', compact('userId'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;

            return view('products.show', compact('product', 'userId'));
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!Auth::check() || Auth::user()->id != $product->user_id) {
            return redirect()->route('products.show', $product->id)->with('danger', 'Você não tem autorização para alterar este produto.');
        }

        return view('products.edit', compact('product'));
    }

    public function search(Request $request)
    {
        try {
            $product = Product::where('name', $request->searchInput)->firstOrFail();

            return view('products.show', compact('product'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')->with('Falhou!', "Não temos um produto com esse nome! Que tal criá-lo agora?");
        }
    }
}