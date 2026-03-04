@extends('admin.maindesign')

@section('add_product')

    @if(session('product_message'))
        <div class="alert alert-success mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('product_message') }}
        </div>
    @endif

    <div class="container-fluid">
        
        <form action="{{ route('admin.post_add_product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="product_title" placeholder="Enter Product Title">
            <textarea name="product_description" placeholder="Product Description">Enter product description here...</textarea>
            <input type="number" name="product_price" placeholder="Enter Product Price">
            <input type="number" name="product_quantity" placeholder="Enter Product Quantity">
            <input type="file" name="product_image" placeholder="Upload Product Image"> <label for="product_image">Upload Product Image</label>
            <select name="category">
                @foreach ($categories as $category )
                <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <input type="submit" name="submit" value="Add Product">
        </form>
    </div>

@endsection