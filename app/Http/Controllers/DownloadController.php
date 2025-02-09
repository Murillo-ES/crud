<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\User;

use Barryvdh\DomPDF\Facade\Pdf;

class DownloadController extends Controller
{
    public function downloadCsv()
    {
        // Get the previous URL name.
        $fullUrl = URL::previous();

        $routeName = Str::chopStart($fullUrl, 'http://crud.test/');

        // Products CSV
        if (Str::startsWith($routeName, 'products')) {
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

        // Users CSV
        } elseif (Str::startsWith($routeName, 'users')) {
            return response()->streamDownload(function(){
                $handle = fopen('php://output', 'w');
    
                fputcsv($handle, ['Nome', 'Data de Cadastro', 'Quantidade de Produtos']);
    
                $usersList = User::all();
    
                foreach ($usersList as $user) {
                    $formattedDate = $user->created_at->format('d/m/Y');
                    $productsCount = count($user->products);
    
                    $userArray = [
                        $user->name,
                        $formattedDate,
                        $productsCount
                    ];
    
                    fputcsv($handle, $userArray);
                }
    
                fclose($handle);
            },  'users.csv', [
                'Content-Type' => 'text/csv',
            ]);

        // Cart CSV
        } elseif (Str::startsWith($routeName, 'cart')) {
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
    }

    public function downloadPdf()
    {
        // Get the previous URL name.
        $fullUrl = URL::previous();

        $routeName = Str::chopStart($fullUrl, 'http://crud.test/');

        // Products PDF
        if (Str::startsWith($routeName, 'products')) {
            $products = Product::all();

            $pdf = Pdf::loadView('pdf.products', compact('products'));

            return $pdf->download('products.pdf');

        // Users PDF
        } elseif (Str::startsWith($routeName, 'users')) {
            $users = User::all();

            $pdf = Pdf::loadView('pdf.users', compact('users'));

            return $pdf->download('users.pdf');

        // Cart PDF
        } elseif (Str::startsWith($routeName, 'cart')) {
            $cartCollection = \Cart::getContent();

            $pdf = Pdf::loadView('pdf.cart', compact('cartCollection'));

            return $pdf->download('cart.pdf');
        }
    }
}
