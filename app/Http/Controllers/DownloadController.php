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
    // Main PDF download method.
    public function downloadPdf()
    {
        $fullUrl = URL::previous();
        $routeName = Str::chopStart($fullUrl, 'http://crud.test/');

        // Available data sources and views
        $exports = [
            'products' => ['data' => Product::all(), 'view' => 'pdf.products', 'filename' => 'products.pdf'],
            'users'    => ['data' => User::all(), 'view' => 'pdf.users', 'filename' => 'users.pdf'],
            'cart'     => ['data' => \Cart::getContent(), 'view' => 'pdf.cart', 'filename' => 'cart.pdf'],
        ];

        // Find the correct exporter based on the route
        foreach ($exports as $key => $export) {
            if (Str::startsWith($routeName, $key)) {
                $pdf = Pdf::loadView($export['view'], ['data' => $export['data']]);
                return $pdf->download($export['filename']);
            }
        }

        // If no matching route is found, return a 404 response
        abort(404, 'Invalid export request.');
    }

    // Main CSV download method.
    public function downloadCsv()
    {
        $fullUrl = URL::previous();
        $routeName = Str::chopStart($fullUrl, 'http://crud.test/');

        // Available data explorers.
        $exporters = [
            'products' => fn() => $this->exportProducts(),
            'users'    => fn() => $this->exportUsers(),
            'cart'     => fn() => $this->exportCart(),
            '' 
        ];

        // Find the correct exporter based on the route
        foreach ($exporters as $key => $exporter) {
            if (Str::startsWith($routeName, $key)) {
                return $exporter();
            }
        }

        // If no matching route is found, return a 404 response
        abort(404, 'Invalid export request.');
    }

    /**
     * Exports products to CSV.
     */
    private function exportProducts()
    {
        return $this->streamCsv('products.csv', ['ID', 'Name', 'Description', 'Price', 'Stock'], function ($handle) {
            $productsList = Product::select(['id', 'name', 'description', 'price', 'stock'])->get();
            foreach ($productsList as $product) {
                fputcsv($handle, $product->toArray());
            }
        });
    }

    /**
     * Exports users to CSV.
     */
    private function exportUsers()
    {
        return $this->streamCsv('users.csv', ['Nome', 'Data de Cadastro', 'Quantidade de Produtos'], function ($handle) {
            $usersList = User::all();
            foreach ($usersList as $user) {
                fputcsv($handle, [
                    $user->name,
                    $user->created_at->format('d/m/Y'),
                    $user->products->count(),
                ]);
            }
        });
    }

    /**
     * Exports cart items to CSV.
     */
    private function exportCart()
    {
        return $this->streamCsv('cart.csv', ['ID', 'Name', 'Description', 'Price', 'Quantity'], function ($handle) {
            $cartCollection = \Cart::getContent();
            foreach ($cartCollection as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->name,
                    $item->attributes->description ?? '',
                    $item->price,
                    $item->quantity,
                ]);
            }
        });
    }

    /**
     * Handles streaming a CSV file.
     */
    private function streamCsv($filename, array $headers, callable $callback)
    {
        return response()->streamDownload(function () use ($headers, $callback) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);
            $callback($handle);
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

}
