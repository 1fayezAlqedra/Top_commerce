@extends('admin.master')
@section('content')
@section('title', 'Edit Category | ' . env('APP_NAME'))

<!-- Page Heading -->
<div class="  d-flex justify-content-between align-items-center mb-0">
    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>
    <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">All Categories</a>
</div>
@include('admin.parts.errors')

<form enctype="multipart/form-data"action="{{ route('admin.categories.update', $category->id) }}" method="post">
    @csrf
    @method('put')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name ='name' placeholder="Name" value="{{ $category->name }}">
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input id="image_input" type="file" class="form-control" name ='image'>
        <img width="70px" id="image_item" src="{{ asset('uploads/images/' . $category->image) }}" alt="...">
    </div>

    <div class="mb-3">
        <label>Parent Id</label>
        <select name="parent_id" class="form-control">
            <option value="" disabled {{ is_null($category->parent_id) ? 'selected' : '' }}>---Select---</option>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}" {{ $category->parent_id == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-5 btn-primary px-5">Update</button>
</form>
@stop
@section('scripts')
<script>
    document.querySelector('#image_item').onclick = function() {
        document.querySelector('#image_input').click();
    }
</script>
@stop
