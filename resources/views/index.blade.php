@extends('maindesign')

@section('index')
    <style>
        /* Section Styling */
        .products_section { padding: 60px 0; background-color: #ffffff; }
        .main-heading { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #2d3436; margin-bottom: 40px; }

        /* The Product Grid */
        .custom-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; }

        /* The Product Card */
        .product-card-wrapper {
            position: relative;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #f1f1f1;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card-wrapper:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            border-color: #f89494;
        }

        /* THE IMAGE FIX: Locked 1:1 Aspect Ratio */
        .img-frame {
            width: 100%;
            height: 280px; /* Fixed height tames high-res images */
            overflow: hidden;
            background: #f9f9f9;
            position: relative;
        }

        .img-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Crops center of high-res photos */
            transition: transform 0.5s ease;
        }

        .product-card-wrapper:hover .img-frame img { transform: scale(1.1); }

        /* Detail Box */
        .info-area { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
        .product-title-text { font-family: 'Inter', sans-serif; font-size: 1.1rem; font-weight: 600; color: #2d3436; margin-bottom: 8px; }
        .price-text { font-size: 1.2rem; font-weight: 700; color: #6366f1; margin-top: auto; }
        .price-label { font-size: 0.8rem; color: #b2bec3; font-weight: 400; text-transform: uppercase; margin-right: 5px; }

        /* "New" Badge */
        .status-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #f89494;
            color: white;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            border-radius: 50px;
            z-index: 2;
        }

        /* Footer Button */
        .view-all-container { margin-top: 50px; text-align: center; }
        .btn-custom-outline {
            padding: 12px 35px;
            border: 2px solid #2d3436;
            color: #2d3436;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-custom-outline:hover { background: #2d3436; color: #fff; }
    </style>

    <div class="container products_section">
        <div class="heading_container heading_center mb-5">
            <h2 class="main-heading text-center">Latest Treasures</h2>
        </div>

        <div class="custom-row">
            @foreach ($products as $product)
                <a href="{{ route('product_details', $product->id) }}" class="text-decoration-none">
                    <div class="product-card-wrapper">
                        {{-- Status Badge --}}
                        <div class="status-badge">New</div>

                        {{-- Image Frame --}}
                        <div class="img-frame">
                            <img src="{{ asset('products/' . $product->product_image) }}" alt="{{ $product->product_title }}">
                        </div>

                        {{-- Detail Box --}}
                        <div class="info-area">
                            <h6 class="product-title-text">{{ $product->product_title }}</h6>
                            <div class="price-text">
                                <span class="price-label">Price</span>${{ number_format($product->product_price, 2) }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="view-all-container">
            <a href="{{ route('all_products') }}" class="btn-custom-outline">
                Browse Full Catalog
            </a>
        </div>
    </div>
@endsection
