@extends('maindesign')

@section('view_cart')

    <div class="container">
        <h2 class="mb-3">My Cart</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>

            @foreach($cart as $cart_product)
                <tr>
                    <td>{{ $cart_product->product->product_title }}</td>
                    <td>{{ $cart_product->product->product_price }}</td>
                    <td>
                        <img src="{{ asset('products/' . $cart_product->product->product_image) }}" alt="product image" width="100">
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
