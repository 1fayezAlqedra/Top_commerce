@extends('admin.master')
@section('content')
@section('title', 'All Categories | ' . env('APP_NAME'))

<!-- Page Heading -->
<div class="  d-flex justify-content-between align-items-center mb-0">
    <h1 class="h3 mb-4 text-gray-800">create new Category</h1>
    <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">All Categories</a>
</div>
@include('admin.parts.errors')

<form enctype="multipart/form-data"action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name ='name' placeholder="Name">
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" class="form-control" name ='image'>
    </div>

    <div class="mb-3">
        <label>Perant Id</label>
        <select name="parent_id" class="form-control">
            <option value="" disabled selected>---Select---</option>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}"> {{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-5 btn-primary px-5">Save</button>


</form>

@stop
