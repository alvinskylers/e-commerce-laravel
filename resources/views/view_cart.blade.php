@extends('maindesign')

@section('view_cart')

    <div class="container">

        @if(session('cart_message'))
            <div class="alert alert-danger mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('cart_message') }}
            </div>
        @endif

        <h2 class="mb-3">My Cart</h2>
        <table class="table ">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @php
            $price = 0;
            @endphp

            @foreach($cart as $cart_product)
                <tr>
                    <td>{{ $cart_product->product->product_title }}</td>
                    <td>${{ $cart_product->product->product_price }}</td>
                    <td>
                        <img src="{{ asset('products/' . $cart_product->product->product_image) }}" alt="product image" width="100">
                    </td>
                    <td> <a href="{{ route('remove_cart_item',$cart_product->id) }}">Remove</a> </td>
                </tr>
                @php
                $price=+$price + $cart_product->product->product_price;
                @endphp
            @endforeach
                <tr class="table-info">
                    <td>Total Price</td>
                    <td>${{ $price  }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

            @if(session('order_message'))
                <div class="alert alert-success mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('order_message') }}
                </div>
            @endif

            <form action="{{ route('confirm_order') }}" method="post">
                @csrf
                <input type="text" name="reciever_address" placeholder="address goes here" required>
                <input type="text" name="reciever_phone" placeholder="phone goes here" required> <input type="submit" name="submit" value="confirm order">
            </form>
    </div>

@endsection
