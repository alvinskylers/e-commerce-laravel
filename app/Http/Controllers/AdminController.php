<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
}
