@extends('admin.maindesign')

<base href="/public">
@section('edit_product')
    <style>
        .edit-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            padding: 35px;
            margin-top: 20px;
        }
        .section-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #4e73df;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: block;
        }
        .form-control-modern {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #fcfdfe;
        }
        .form-control-modern:focus {
            border-color: #4e73df;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
        }
        .current-img-box {
            border: 1px solid #eaecf4;
            padding: 10px;
            border-radius: 10px;
            background: #f8f9fc;
            text-align: center;
            margin-bottom: 15px;
        }
        .preview-container {
            border: 2px dashed #d1d9e6;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .btn-update-large {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
            cursor: pointer;
        }
        .btn-update-large:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
    </style>

    <div class="container py-4">
        @if(session('update_message'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="fa fa-check-circle mr-2"></i> {{ session('update_message') }}
            </div>
        @endif

        <div class="edit-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="m-0 fw-bold text-dark">Edit Product</h3>
                <a href="{{ route('admin.view_product') }}" class="btn btn-light btn-sm rounded-pill border">
                    <i class="fa fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <form action="{{ route('admin.post_edit_product',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <span class="section-label">Main Info</span>
                        <label class="small fw-bold text-muted">Product Title</label>
                        <input type="text" name="product_title" class="form-control-modern" value="{{ $product->product_title }}" required>

                        <label class="small fw-bold text-muted">Description</label>
                        <textarea name="product_description" class="form-control-modern" style="height: 150px;">{{ $product->product_description }}</textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Price ($)</label>
                                <input type="number" name="product_price" class="form-control-modern" value="{{ $product->product_price }}" step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Inventory</label>
                                <input type="number" name="product_quantity" class="form-control-modern" value="{{ $product->product_quantity }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 border-left pl-lg-4">
                        <span class="section-label">Product Organization</span>
                        <label class="small fw-bold text-muted">Category</label>
                        <select name="category" class="form-control-modern">
                            @foreach ($categories as $category )
                                <option value="{{ $category->category }}" {{ $product->product_category == $category->category ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>

                        <span class="section-label mt-3">Media Management</span>
                        <div class="row">
                            <div class="col-6">
                                <p class="small text-muted text-center mb-1">Current Image</p>
                                <div class="current-img-box">
                                    <img src="{{ asset('products/' . $product->product_image) }}" class="img-fluid rounded" style="max-height: 100px;">
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="small text-muted text-center mb-1">New Preview</p>
                                <div class="preview-container" id="preview-box">
                                    <img id="new-preview-img" src="#" style="max-height: 100px; display: none;" class="rounded">
                                    <i id="upload-icon" class="fa fa-cloud-upload text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="product_image" class="btn btn-outline-secondary btn-sm btn-block">
                                <i class="fa fa-camera"></i> Replace Image
                            </label>
                            <input type="file" name="product_image" id="product_image" style="display:none;" onchange="updatePreview()">
                        </div>

                        <button type="submit" name="submit" class="btn-update-large mt-4">
                            Update Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updatePreview() {
            const preview = document.getElementById('new-preview-img');
            const icon = document.getElementById('upload-icon');
            const file = document.getElementById('product_image').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                preview.style.display = "block";
                icon.style.display = "none";
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
