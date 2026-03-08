@extends('admin.maindesign')

@section('view_orders')

    <div class="container-fluid py-4" style="background-color: #f0f2f5; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 25px;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <h2 style="font-weight: 700; color: #1a202c; margin: 0;">📦 Order Management</h2>

                <form method="post" action="{{ route('admin.search_products') }}" style="display: flex; gap: 10px;">
                    @csrf
                    <input type="text" name="search" placeholder="Search orders..."
                           style="padding: 8px 15px; border-radius: 8px; border: 1px solid #cbd5e0; outline: none; width: 250px;">
                    <button type="submit" class="btn btn-primary" style="border-radius: 8px; background-color: #4a90e2; border: none; padding: 8px 20px;">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr style="background-color: #f8fafc; text-align: left; color: #718096; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">
                        <th style="padding: 15px; border-bottom: 2px solid #edf2f7;">Customer & Contact</th>
                        <th style="padding: 15px; border-bottom: 2px solid #edf2f7;">Shipping Address</th>
                        <th style="padding: 15px; border-bottom: 2px solid #edf2f7;">Product Details</th>
                        <th style="padding: 15px; border-bottom: 2px solid #edf2f7;">Price</th>
                        <th style="padding: 15px; border-bottom: 2px solid #edf2f7;">Status Management</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;">
                            <td style="padding: 15px;">
                                <div style="font-weight: 700; color: #2d3748;">{{ $order->user->name }}</div>
                                <div style="font-size: 0.85rem; color: #718096;"><i class="fa fa-phone"></i> {{ $order->reciever_phone }}</div>
                            </td>

                            <td style="padding: 15px; max-width: 200px;">
                                <div style="font-size: 0.9rem; color: #4a5568; line-height: 1.4;">
                                    <i class="fa fa-map-marker text-danger"></i> {{ $order->reciever_address }}
                                </div>
                            </td>

                            <td style="padding: 15px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="{{ asset('products/' . $order->product->product_image) }}"
                                         style="width: 50px; height: 50px; border-radius: 6px; object-fit: cover; border: 1px solid #e2e8f0;">
                                    <div>
                                        <div style="font-weight: 600; font-size: 0.9rem;">{{ $order->product->product_title }}</div>
                                        <span style="font-size: 0.75rem; background: #edf2f7; padding: 2px 6px; border-radius: 4px;">{{ $order->product->product_category }}</span>
                                    </div>
                                </div>
                            </td>

                            <td style="padding: 15px;">
                                <span style="font-weight: 700; color: #2f855a;">${{ number_format($order->product->product_price, 2) }}</span>
                            </td>

                            <td style="padding: 15px;">
                                <form action="{{ route('admin.update_status', $order->id) }}" method="post" style="display: flex; gap: 5px;">
                                    @csrf
                                    <select name="status" style="padding: 6px; border-radius: 6px; border: 1px solid #cbd5e0; font-size: 0.85rem; background: #fff;">
                                        <option value="{{ $order->status }}" selected disabled>{{ $order->status }}</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="In Progress">In Progress</option>
                                    </select>
                                    <button type="submit" style="background: #4a90e2; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.8rem;"
                                            onclick="return confirm('Update order status?')">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
