@extends('admin.maindesign')

@section('add_category')
    <style>
        .admin-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            max-width: 600px;
            margin: 20px auto;
        }
        .admin-header {
            border-bottom: 2px solid #f4f7f6;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }
        .admin-header h3 {
            font-weight: 700;
            color: #333;
            font-size: 1.25rem;
            margin: 0;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .admin-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dce1e4;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
            margin-bottom: 20px;
        }
        .admin-input:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }
        .btn-admin-submit {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        .btn-admin-submit:hover {
            background-color: #2e59d9;
        }
        .alert-custom {
            max-width: 600px;
            margin: 0 auto 20px auto;
        }
    </style>

    <div class="container-fluid py-4">

        @if(session('category_message'))
            <div class="alert alert-success alert-custom shadow-sm border-0 d-flex align-items-center" role="alert">
                <i class="fa fa-check-circle mr-2"></i>
                <div>{{ session('category_message') }}</div>
            </div>
        @endif

        <div class="admin-card">
            <div class="admin-header">
                <h3><i class="fa fa-plus-square mr-2" style="color: #4e73df;"></i> Create New Category</h3>
            </div>

            <form action="{{ route('admin.post_addcategory') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category" class="admin-input" placeholder="e.g. Electronics, Home Decor..." required>
                </div>

                <button type="submit" name="submit" class="btn-admin-submit">
                    Add Category
                </button>
            </form>
        </div>
    </div>

@endsection
