@extends('admin.maindesign')

<base href="/public">
@section('edit_product')

    @if(session('update_message'))
        <div class="alert alert-success mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('update_message') }}
        </div>
    @endif

    <div class="container-fluid">
        
        <form action="{{ route('admin.post_edit_product',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="product_title" value="{{ $product->product_title }}" >
            <textarea name="product_description" ="">{{ $product->product_description }}</textarea>
            <input type="number" name="product_price" value="{{ $product->product_price }}" >
            <input type="number" name="product_quantity" value="{{ $product->product_quantity }}" >
            <img src="{{ asset('products/' . $product->product_image) }}" alt="Product Image" width="100"> <label>current image</label>
            <input type="file" name="product_image" =" Image"> <label for="product_image">Upload Product Image</label>
            <select name="category">
                @foreach ($categories as $category )
                <option value="{{ $product->product_category }}" {{ $product->product_category == $category->category ? 'selected' : '' }}>
                    {{ $category->category }}
                </option>
                @endforeach
            </select>
            <input type="submit" name="submit" value="Update Product">
        </form>
    </div>

@endsection