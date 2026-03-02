@extends('admin.maindesign')

<base href="/public">
@section('edit_category')

    @if(session('edit_message'))
        <div class="alert alert-success mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('edit_message') }}
        </div>
    @endif

    <div class="container-fluid">
        
        <form action="{{ route('admin.update_category', $category->id) }}" method="post">
            @csrf
            <input type="text" name="category" placeholder="Enter Category" value="{{ $category->category }}">
            <input type="submit" name="submit" value="Update Category">
        </form>
    </div>

@endsection