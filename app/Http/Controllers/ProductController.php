<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
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

    public function exportToPDF()
    {
        $products = Product::all();

        $pdf = Pdf::loadView('pdf.products', compact('products'));

        return $pdf->download('products.pdf');
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