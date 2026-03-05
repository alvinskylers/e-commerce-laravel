<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;

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
        if (Auth::check()) {
            $totalItemsInCart = ProductCart::where('user_id', Auth::id())->count();
        } else  {
            $totalItemsInCart = '';
        }

        $products = Product::latest()->take(8)->get();
        return view('index',compact('products','totalItemsInCart'));
    }

    public function product_details($id)
    {
        if (Auth::check()) {
            $totalItemsInCart = ProductCart::where('user_id', Auth::id())->count();
        } else  {
            $totalItemsInCart = '';
        }

        $product = Product::findOrFail($id);
        return view('product_details',compact('product','totalItemsInCart'));
    }

    public function all_products()
    {
        $products = Product::all();
        return view('all_products',compact('products'));
    }

    public function add_product_to_cart($id)
    {
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;

        $product_cart->save();
        return redirect()->back()->with('cart_message','product added to cart');
    }
}
