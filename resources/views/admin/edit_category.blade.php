@extends('admin.maindesign')

<base href="/public">
@section('edit_category')
    <style>
        .edit-container {
            max-width: 700px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .edit-header {
            background: #f8f9fa;
            padding: 20px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .edit-body {
            padding: 40px 30px;
        }
        .form-label {
            font-weight: 700;
            color: #444;
            margin-bottom: 10px;
            display: block;
            font-size: 0.9rem;
        }
        .edit-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .edit-input:focus {
            border-color: #007bff;
            outline: none;
            background-color: #f0f7ff;
        }
        .btn-save {
            background: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: 0.3s;
            cursor: pointer;
        }
        .btn-save:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .btn-back {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-back:hover {
            color: #333;
        }
    </style>

    <div class="container-fluid">

        @if(session('edit_message'))
            <div class="alert alert-success border-0 shadow-sm mb-4 mx-auto" style="max-width: 700px;">
                <i class="fa fa-check-circle mr-2"></i> {{ session('edit_message') }}
            </div>
        @endif

        <div class="edit-container">
            <div class="edit-header">
                <h4 class="m-0 text-dark fw-bold">
                    <i class="fa fa-pencil-square-o text-primary mr-2"></i> Edit Category
                </h4>
                <a href="{{ route('admin.view_category') }}" class="btn-back">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="edit-body">
                <form action="{{ route('admin.update_category', $category->id) }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="form-label">Current Category Name</label>
                        <input type="text"
                               name="category"
                               class="edit-input"
                               placeholder="Enter Category"
                               value="{{ $category->category }}"
                               required>
                        <small class="text-muted mt-2 d-block">Modify the name above and click save to update the database.</small>
                    </div>

                    <button type="submit" name="submit" class="btn-save shadow-sm">
                        <i class="fa fa-save mr-1"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
