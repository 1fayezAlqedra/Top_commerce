@extends('admin.master')
@section('content')
@section('title', 'Edit Product | ' . env('APP_NAME'))

<!-- Page Heading -->
<div class="  d-flex justify-content-between align-items-center mb-0">
    <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.index') }}">All products</a>
</div>
@include('admin.parts.errors')
<form enctype="multipart/form-data"action="{{ route('admin.products.update', $product->id) }}" method="post">
    @csrf
    @method('put')

    @include('admin.categories.forms.form')

    {{-- <div class="mb-3">
        <label>Category </label>
        <select name="category_id" class="form-control">
            <option value="" disabled {{ is_null($product->category_id->name) ? 'selected' : '' }}>---Select---
            </option>
            @foreach ($products as $item)
                <option value="{{ $item->id }}"
                    {{ $product->category_id == $item->category_id ? 'selected' : '' }}>
                    {{ $item->category_id->name }}
                </option>
            @endforeach
        </select>
    </div> --}}
    <button class="btn btn-5 btn-primary px-5">Update</button>
</form>
@stop
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let trigger = document.querySelector('#image_item');
        let input = document.querySelector('#image_input');
        if (trigger && input) {
            trigger.onclick = function() {
                input.click();
            };
        }
    });
</script>
@stop
