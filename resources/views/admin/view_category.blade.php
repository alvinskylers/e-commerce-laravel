@extends('admin.maindesign')

@section('view_category')
    <style>
        .admin-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 25px;
            margin-top: 20px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 15px;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .table tbody td {
            vertical-align: middle;
            color: #666;
            font-size: 0.95rem;
        }
        .btn-action {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none !important;
            transition: 0.3s;
            display: inline-block;
        }
        .btn-update {
            background-color: #e3f2fd;
            color: #1976d2 !important;
        }
        .btn-update:hover {
            background-color: #1976d2;
            color: #fff !important;
        }
        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f !important;
            margin-left: 10px;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
            color: #fff !important;
        }
        .category-id {
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            color: #999;
        }
    </style>

    <div class="container-fluid">

        @if(session('delete_message'))
            <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center">
                <i class="fa fa-trash-o mr-2"></i>
                {{ session('delete_message') }}
            </div>
        @endif

        <div class="admin-container">
            <div class="page-header">
                <h2 class="m-0 fw-bold">Manage Categories</h2>
                <a href="{{ route('admin.add_category') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fa fa-plus"></i> Add New
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Category Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><span class="category-id">#{{ $category->id }}</span></td>
                            <td class="fw-bold text-dark">{{ $category->category }}</td>
                            <td><small>{{ $category->created_at->format('M d, Y') }}</small></td>
                            <td><small>{{ $category->updated_at->format('M d, Y') }}</small></td>
                            <td class="text-center">
                                <a href="{{ route('admin.update_category', $category->id) }}" class="btn-action btn-update">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                                <a href="{{ route('admin.delete_category', $category->id) }}"
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
