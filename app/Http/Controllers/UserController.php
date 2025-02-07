<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function details($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $products = Product::where('user_id', $id)->get();

        return view('user.details', compact('user', 'products'));
    }

    public function exportToCSV()
    {
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
    }

    public function exportToPDF()
    {
        $users = User::all();

        $pdf = Pdf::loadView('pdf.users', compact('users'));

        return $pdf->download('users.pdf');
    }
}
