<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

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
}
