<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Orders;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function view_cart()
    {
        if (Auth::check()) {
            $totalItemsInCart = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        } else  {
            $totalItemsInCart = '';
        }

        return view('view_cart',compact('totalItemsInCart','cart'));
    }

    public function remove_cart_item($id)
    {
        $cart_product = ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back()->with('cart_message','product removed from cart');
    }

    public function confirm_order(Request $request)
    {

        $cart_items = ProductCart::where('user_id', Auth::id())->get();

        foreach($cart_items as $item) {
            $order = new Orders();
            $order->reciever_address = $request->reciever_address;
            $order->reciever_phone = $request->reciever_phone;
            $order->user_id = Auth::id();
            $order->product_id = $item->product_id;

            $order->save();
        }

        ProductCart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('order_message', 'Order has been placed successfully!');
    }

    public function view_orders()
    {
        $orders =  Orders::where('user_id', Auth::id())->get();
        return view('view_orders',compact('orders'));
    }

    public function download_invoice($id)
    {
        $data = Orders::findOrFail($id);
        $pdf = Pdf::loadView('invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
