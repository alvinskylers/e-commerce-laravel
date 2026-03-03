@extends('admin.maindesign')

@section('view_product')

    @if(session(''))
        <div class="alert alert-danger mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session(key: '') }}
        </div>
    @endif

    <div class="container-fluid">
        <h2>Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_title }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>
                        <img src="{{ asset('products/' . $product->product_image) }}" alt="Product Image" width="100">
                    </td>
                    <td>{{ $product->product_category }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    {{-- <td>
                       <a href="{{ route('', $proEnter product description here...duct->id) }}" style="color: #90D5FF;">Update</a>
                        <a href="{{ route('', $product->id) }}" 
                           class="text-red-600 ml-2" 
                           onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

