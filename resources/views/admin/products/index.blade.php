@extends('admin.master')
@section('content')
@section('title', 'All Produtrs | ' . env('APP_NAME'))
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
    <h1 class="h3 mb-4 text-gray-800">All Products</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Add new Product</a>
</div>
@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
@endif
<table class="table table-hover table-stried table-borderd">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>price</th>
        <th>sale_price</th>
        <th>quntity</th>
        <th>category</th>
        <th>Ceriated At</th>

    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td><img width="100px" src="{{ asset('uploads/images/' . $product->image) }}" alt="..."></td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>
                @if ($product->quntity > 20)
                    <span class="badge badge-success">{{ $product->quntity }}</span>
                @else
                    <span class="badge badge-danger">{{ $product->quntity }}</span>
                @endif
            </td>

            <td>{{ $product->parentCategory?->name ?? '—' }}</td>
            <td>{{ $product->created_at->diffForHumans() }}</td>

            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('admin.products.edit', $product->id) }}">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form class="d-inline" method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
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

{{ $products->links() }}

@stop
