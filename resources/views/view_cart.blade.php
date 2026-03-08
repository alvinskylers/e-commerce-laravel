@extends('maindesign')

@section('view_cart')
    <style>
        .cart-container { background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #eee; }
        .remove-link { color: #dc3545; text-decoration: none; font-weight: 500; font-size: 0.9rem; }
        .remove-link:hover { text-decoration: underline; }
        .checkout-section { background: #f8f9fa; padding: 20px; border-radius: 10px; margin-top: 30px; }
        .form-control-custom { border-radius: 8px; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; width: 100%; }
        .btn-confirm { background: #28a745; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; width: 100%; transition: 0.3s; }
        .btn-confirm:hover { background: #218838; transform: translateY(-1px); }
    </style>

    <div class="container my-5">
        <div class="cart-container">
            <h2 class="mb-4 fw-bold">🛒 My Shopping Cart</h2>

            @if(session('cart_message'))
                <div class="alert alert-warning border-0 shadow-sm mb-4">
                    {{ session('cart_message') }}
                </div>
            @endif

            @if(session('order_message'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    {{ session('order_message') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                    <tr>
                        <th colspan="2">Product</th>
                        <th>Price</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $totalPrice = 0; @endphp
                    @foreach($cart as $cart_product)
                        <tr>
                            <td style="width: 100px;">
                                <img src="{{ asset('products/' . $cart_product->product->product_image) }}"
                                     alt="product image" class="product-img">
                            </td>
                            <td>
                                <div class="fw-bold">{{ $cart_product->product->product_title }}</div>
                                <small class="text-muted">Item ID: #{{ $cart_product->id }}</small>
                            </td>
                            <td class="fw-bold text-dark">${{ number_format($cart_product->product->product_price, 2) }}</td>
                            <td class="text-end">
                                <a href="{{ route('remove_cart_item',$cart_product->id) }}" class="remove-link">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                        @php $totalPrice += $cart_product->product->product_price; @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="fs-5">
                        <td colspan="2" class="text-end fw-bold">Estimated Total:</td>
                        <td colspan="2" class="fw-bold text-success text-start">${{ number_format($totalPrice, 2) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-6">
                    <div class="checkout-section">
                        <h5 class="mb-3 fw-bold">Delivery Details</h5>
                        <form action="{{ route('confirm_order') }}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label class="small fw-bold">Shipping Address</label>
                                <input type="text" name="reciever_address" class="form-control-custom" placeholder="123 Street Name, City" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold">Phone Number</label>
                                <input type="text" name="reciever_phone" class="form-control-custom" placeholder="+1 234 567 890" required>
                            </div>
                            <button type="submit" class="btn-confirm">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
