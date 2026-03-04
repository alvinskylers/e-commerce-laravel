<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function add_category()
    {
        return view('admin.add_category');
    }

    public function post_addcategory(Request $request)
    {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category added successfully!');
    }

    public function view_categories()
    {
        $categories = Category::all();
        return view('admin.view_category',compact('categories'));
    }

    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
            return redirect()->back()->with('delete_message','Category deleted successfully!');
        }

        return redirect()->back()->with('delete_message','Category not found!');
    }

    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            return view('admin.edit_category',compact('category'));
        }

        return redirect()->back()->with('edit_message','Category not found!');
    }

    public function post_editcategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if($category){
            $category->category = $request->category;
            $category->save();
            return redirect()->back()->with('edit_message','Category updated successfully!');
        }

        return redirect()->back()->with('edit_message','Category not found!');
    }

    public function add_product()
    {
        $categories = Category::all();
        return view('admin.add_product',compact('categories'));
    }

    public function post_add_product(Request $request)
    {
        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->product_category = $request->category;
        
        $image = $request->product_image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $product->product_image = $imageName;
        }
        
        $product->save();
        
        if ($image && $product-> save()) {
            $request->product_image->move('products',$imageName);
        }


        return redirect()->back()->with('product_message','Product added successfully!');
    }

    public function view_products()
    {
        $products = Product::paginate(5);
        return view('admin.view_product',compact('products'));
    }

    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        $image_path = public_path('products/' . $product->product_image);
        
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        if($product){
            $product->delete();
            return redirect()->back()->with('delete_message','Product deleted successfully!');
        }

        return redirect()->back()->with('delete_message','Product not found!');
    }

    public function update_product($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        if($product){
            return view('admin.edit_product',compact('product','categories'));
        }

        return redirect()->back()->with('update_message','Product not found!');
    }

    public function post_edit_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if($product){
            $product->product_title = $request->product_title;
            $product->product_description = $request->product_description;
            $product->product_price = $request->product_price;
            $product->product_quantity = $request->product_quantity;
            $product->product_category = $request->category;
            
            $image = $request->product_image;
            if ($image) {
                // Delete old image
                $oldImagePath = public_path('products/' . $product->product_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                
                // Save new image
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $product->product_image = $imageName;
                $request->product_image->move('products', $imageName);
            }
            
            $product->save();
            return redirect()->back()->with('update_message','Product updated successfully!');
        }

        return redirect()->back()->with('update_message','Product not found!');
    }
}
