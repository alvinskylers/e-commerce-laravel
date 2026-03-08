@extends('admin.maindesign')

@section('add_product')
    <style>
        .product-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
            padding: 30px;
            margin-top: 20px;
        }
        .form-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f2f5;
            display: flex;
            align-items: center;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            font-size: 0.85rem;
            margin-bottom: 8px;
            display: block;
        }
        .product-input, .product-select, .product-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        .product-input:focus, .product-textarea:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
            outline: none;
        }
        .product-textarea { height: 120px; resize: vertical; }

        .file-upload-wrapper {
            border: 2px dashed #d1d9e6;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            background: #f8f9fc;
            cursor: pointer;
            transition: 0.3s;
        }
        .file-upload-wrapper:hover { border-color: #4e73df; background: #f0f4ff; }

        .btn-publish {
            background: #1cc88a;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-weight: 700;
            width: 100%;
            margin-top: 10px;
            font-size: 1rem;
            transition: 0.3s;
        }
        .btn-publish:hover { background: #17a673; transform: translateY(-2px); }
        .image-preview-container {
            width: 100%;
            height: 200px;
            border: 2px dashed #d1d9e6;
            border-radius: 10px;
            background: #f8f9fc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 15px;
            position: relative;
        }

        #preview-image {
            max-width: 100%;
            max-height: 100%;
            display: none; /* Hidden until an image is chosen */
        }

        .placeholder-text {
            color: #adb5bd;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>

    <div class="container py-4">
        <div class="product-card shadow-sm">
            <form action="{{ route('admin.post_add_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-section-title"><i class="fa fa-info-circle mr-2"></i> Product Details</div>
                        <label class="form-label">Product Title</label>
                        <input type="text" name="product_title" class="product-input" placeholder="Enter Title" required>

                        <label class="form-label">Description</label>
                        <textarea name="product_description" class="product-textarea" placeholder="Describe your product..."></textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" name="product_price" class="product-input" step="0.01" placeholder="0.00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="product_quantity" class="product-input" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-section-title"><i class="fa fa-image mr-2"></i> Product Media</div>

                        <div class="image-preview-container" id="image-preview-box">
                            <img id="preview-image" src="#" alt="Preview">
                            <div class="placeholder-text" id="placeholder-text">
                                <i class="fa fa-camera fa-2x mb-2"></i><br>
                                No image selected
                            </div>
                        </div>

                        <label for="product_image" class="btn btn-outline-primary btn-block mt-3">
                            <i class="fa fa-upload"></i> Choose Image
                        </label>
                        <input type="file" name="product_image" id="product_image" style="display:none;" onchange="previewFile()">

                        <label class="form-label mt-4">Category</label>
                        <select name="category" class="product-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn-publish mt-4">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const file = document.querySelector('input[type=file]').files[0];
            const placeholder = document.getElementById('placeholder-text');
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                preview.style.display = "block";
                placeholder.style.display = "none";
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
