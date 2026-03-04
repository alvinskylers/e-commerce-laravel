<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->user_type == 'user') {
            return view('dashboard');
        }

        if (Auth::check() && Auth::user()->user_type == 'admin') {
            return view('admin.dashboard');
        }
    }

    public function home()
    {
        $products = Product::latest()->take(8)->get();
        return view('index',compact('products'));
    }

    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        return view('product_details',compact('product'));
    }

    public function all_products()
    {
        $products = Product::all();
        return view('all_products',compact('products'));
    }
}
