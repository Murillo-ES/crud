<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    // User List
    public function index()
    {
        return view('user.index');
    }

    // Return user's details by ID.
    public function details($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $products = Product::where('user_id', $id)->get();

        return view('user.details', compact('user', 'products'));
    }
}
