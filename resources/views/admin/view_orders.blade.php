@extends('admin.maindesign')

@section('view_orders')

    <div class="container-fluid">
        <h2>Products</h2>
        <div>
            <form method="post" action="{{ route('admin.search_products') }}">
                @csrf
                <input type="text" name="search" placeholder="Search products..." class="form-control mb-3 col-3 d-inline-block">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Customer</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->reciever_address }}</td>
                    <td>{{ $order->reciever_phone }}</td>
                    <td>{{ $order->product->product_title }}</td>
                    <td>{{ $order->product->product_price }}</td>
                    <td>
                        <img src="{{ asset('products/' . $order->product->product_image) }}" alt="Product Image" width="100">
                    </td>
                    <td>{{ $order->product->product_category }}</td>
                    <td>
                        <form action="{{ route('admin.update_status', $order->id) }}" method="post">
                            @csrf
                            <select name="status" id="">
                                <option value="{{ $order->status }}">{{ $order->status }}</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <input type="submit" name="submit" value="submit" onclick="return confirm('Are you sure?')">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
