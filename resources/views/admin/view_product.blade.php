@extends('admin.maindesign')

@section('view_product')

    <style>
        /* Custom Color Variables */
        :root {
            --admin-bg: #f8fafc;
            --admin-card-header: #1e293b; /* Deep Slate */
            --admin-primary: #6366f1;     /* Indigo */
            --admin-success: #10b981;     /* Emerald */
            --admin-danger: #f43f5e;      /* Rose/Red */
            --admin-text-main: #334155;
        }

        .custom-card { border-radius: 15px; border: none; background: #ffffff; }
        .table-thead { background-color: #f1f5f9; color: #475569; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
        .product-title { color: #1e293b; font-weight: 600; }
        .price-tag { color: var(--admin-primary); font-weight: 700; font-size: 1.1rem; }
        .btn-edit { color: var(--admin-primary); border: 1px solid #e2e8f0; background: white; transition: 0.3s; }
        .btn-edit:hover { background: var(--admin-primary); color: white; }
        .btn-delete { color: var(--admin-danger); border: 1px solid #fee2e2; background: #fff1f2; transition: 0.3s; }
        .btn-delete:hover { background: var(--admin-danger); color: white; }
        .search-input { border-radius: 10px 0 0 10px !important; border: 1px solid #e2e8f0; }
        .search-btn { border-radius: 0 10px 10px 0 !important; background: var(--admin-card-header); border: none; }
    </style>

    <div class="container-fluid py-5" style="background-color: var(--admin-bg); min-height: 100vh;">

        {{-- Modern Alert --}}
        @if(session('delete_message'))
            <div class="alert shadow-sm border-0 d-flex align-items-center" style="background: #ecfdf5; color: #065f46; border-radius: 12px;">
                <span class="me-3" style="font-size: 1.5rem;">✨</span>
                <div><strong>Success!</strong> {{ session('delete_message') }}</div>
            </div>
        @endif

        {{-- Header & Search --}}
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="fw-extrabold m-0" style="color: var(--admin-card-header);">Inventory Management</h2>
                <p class="text-muted small">Manage your shop's stock and pricing here.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <form method="post" action="{{ route('admin.search_products') }}" class="d-inline-flex shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    @csrf
                    <input type="text" name="search" placeholder="Search products..." class="form-control search-input px-3">
                    <button type="submit" class="btn btn-dark search-btn px-4 text-white">
                        Find
                    </button>
                </form>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card custom-card shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-thead">
                    <tr>
                        <th class="px-4 py-3">Product Info</th>
                        <th>Status/Qty</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>History</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('products/' . $product->product_image) }}"
                                         class="rounded-3 shadow-sm me-3"
                                         style="width: 55px; height: 55px; object-fit: cover;">
                                    <div>
                                        <div class="product-title">{{ $product->product_title }}</div>
                                        <small class="text-muted">ID: #{{ $product->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->product_quantity > 0)
                                    <span class="badge bg-soft-success text-success" style="background: #d1fae5;">
                                    {{ $product->product_quantity }} In Stock
                                </span>
                                @else
                                    <span class="badge bg-soft-danger text-danger" style="background: #fee2e2;">Out of Stock</span>
                                @endif
                            </td>
                            <td><span class="price-tag">${{ number_format($product->product_price, 2) }}</span></td>
                            <td>
                            <span class="badge rounded-pill text-dark border px-3" style="background: #f8fafc;">
                                {{ $product->product_category }}
                            </span>
                            </td>
                            <td class="small text-muted">
                                <i class="far fa-clock me-1"></i> {{ $product->updated_at->diffForHumans() }}
                            </td>
                            <td class="text-center px-4">
                                <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                    <a href="{{ route('admin.update_product', $product->id) }}" class="btn btn-sm btn-edit px-3">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.delete_product', $product->id) }}"
                                       class="btn btn-sm btn-delete px-3"
                                       onclick="return confirm('Remove this product permanently?')">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>

@endsection
