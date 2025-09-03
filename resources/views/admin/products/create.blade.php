@extends('admin.master')
@section('content')
@section('title', 'All Products | ' . env('APP_NAME'))

<!-- Page Heading -->
<div class="  d-flex justify-content-between align-items-center mb-0">
    <h1 class="h3 mb-4 text-gray-800">Add new Product</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.index') }}">All Prosucts</a>
</div>
@include('admin.parts.errors')

<form enctype="multipart/form-data"action="{{ route('admin.products.store') }}" method="post">
    @csrf
    @include('admin.categories.forms.form')

    <button class="btn btn-5 btn-primary px-5">Save</button>


</form>

@stop
