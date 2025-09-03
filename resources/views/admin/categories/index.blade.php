@extends('admin.master')
@section('content')
@section('title', 'All Categories | ' . env('APP_NAME'))
@section('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;




        }
    </style>
@stop
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-4 text-gray-800">All Categories</h1>
    <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Add new Category</a>
</div>
@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
@endif
<table class="table table-hover table-stried table-borderd">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>Parent</th>
        <th>Products Count</th>
        <th>Action</th>
    </tr>
    @foreach ($Categories as $Category)
        <tr>
            <td>{{ $Category->id }}</td>
            <td>{{ $Category->name }}</td>
            <td><img width="100px" src="{{ asset('uploads/images/' . $Category->image) }}" alt="..."></td>
            <td>{{ $Category->parent->name }}</td>
            <td>
                <span class="badge badge-primary px-2 ">
                    {{ $Category->products_count }}
                </span>
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('admin.categories.edit', $Category->id) }}">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form class="d-inline" method="POST" action="{{ route('admin.categories.destroy', $Category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $Categories->links() }}

@stop
