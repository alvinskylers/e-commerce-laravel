@extends('maindesign')
<base href="/public">
@section('product_details')

    @if(session('cart_message'))
        <div class="alert alert-success mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('cart_message') }}
        </div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card product-card">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset('products/' . $product->product_image) }}" class="img-fluid rounded-start" alt="{{ $product->product_title }}">
                    </div>

                    <div class="col-md-6">
                        <div class="card-body p-4">

                            <h2 class="card-title fw-bold">{{ $product->product_title }}</h2>
                            <p class="text-muted small">{{ $product->product_category}}</p>

                            <h3 class="text-primary my-3">${{ number_format($product->product_price, 2) }}</h3>

                            <p class="card-text text-secondary">
                                {{ $product->product_description }}
                            </p>

                            <div class="d-grid gap-2 mt-4">
                                <a class="btn btn-primary btn-lg" type="button" href="{{ route('add_to_cart', $product->id) }}">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4 text-secondary">Customer Reviews (2)</h4>

            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">JD</div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold">  John Doe</h6>
                            <small class="text-muted">  Posted 2 days ago</small>
                        </div>
                    </div>
                    <p class="card-text text-secondary">I've been using this watch for a week now. The battery life is actually better than advertised! Highly recommend.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4 bg-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">Leave a Review</h5>
                    <form>
                        <div class="mb-3">
                            <label for="userName" class="form-label small fw-bold">Your Name</label>
                            <input type="text" class="form-control form-control-sm" id="userName" placeholder="e.g. Jane Smith">
                        </div>
                        <div class="mb-3">
                            <label for="commentText" class="form-label small fw-bold">Your Message</label>
                            <textarea class="form-control" id="commentText" rows="3" placeholder="What did you think of the product?"></textarea>
                        </div>
                        <button type="button" class="btn btn-dark btn-sm px-4">Post Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
