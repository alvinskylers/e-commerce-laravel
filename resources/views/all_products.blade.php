@extends('maindesign')

@section('all_products')
<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
        padding: 40px 0;
    }

    .product-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #f1f1f1;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        border-color: #f89494;
    }

    /* THE FIX: Fixed height wrapper for all resolutions */
    .product-img-wrapper {
        width: 100%;
        height: 300px; /* Lock the height for every single card */
        position: relative;
        background: #fdfdfd;
        overflow: hidden; /* This cuts off any excess resolution/pixels */
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* This crops the high-res image to fill the 300px box */
        object-position: center;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-img-wrapper img {
        transform: scale(1.1);
    }

    .product-info {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        background: #fff;
    }

    .product-cat {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #f89494;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1a1a1a;
        line-height: 1.3;
    }

    .product-price {
        font-weight: 700;
        font-size: 1.2rem;
        color: #2d3436;
        margin-top: auto;
    }

    .btn-view {
        margin-top: 20px;
        background: #2d3436;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        padding: 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        transition: 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-view:hover {
        background: #f89494;
        color: white;
        box-shadow: 0 10px 20px rgba(248, 148, 148, 0.3);
    }
</style>

<div class="product-grid">
    @foreach($products as $product)
        <div class="product-card">
            <div class="product-img-wrapper">
                <img src="{{ asset('products/' . $product->product_image) }}" alt="{{ $product->product_title }}">
            </div>

            <div class="product-info">
                <span class="product-cat">{{ $product->product_category }}</span>
                <h3 class="product-name">{{ $product->product_title }}</h3>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="product-price">${{ number_format($product->product_price, 2) }}</div>
                </div>

                <a href="{{ url('product_details', $product->id) }}" class="btn-view">
                    View Product
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
