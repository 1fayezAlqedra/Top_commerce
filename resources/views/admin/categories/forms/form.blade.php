<div class="mb-3">
    <label>Name</label>
    <input type="text" class="form-control" name ='name' placeholder="Name" value="{{ $product->name }}">
</div>
<div class="mb-3">
    <label>Image</label>
    <input type="file" class="form-control" name ='image' value="{{ $product->image }}">
</div>
<div class="mb-3">
    <label>description</label>
    <textarea id="myeditorinstance" class="form-control" name="description" placeholder="Description" rows="5">
{!! old('description', $product->description ?? '') !!}
    </textarea>

</div>
<div class="mb-3">
    <label>price</label>
    <input type="number" class="form-control" name ='price' placeholder="price"value="{{ $product->price }}">
</div>
<div class="mb-3">
    <label>sale_price</label>
    <input type="number" class="form-control" name ='sale_price'
        placeholder="sale_price"value="{{ $product->sale_price }}">
</div>
<div class="mb-3">
    <label>quntity</label>
    <input type="number" class="form-control" name ='quntity' placeholder="quntity"value="{{ $product->quntity }}">
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option value="" disabled selected>---Select---</option>
        @foreach ($categories as $item)
            <option value="{{ $item->id }}"
                {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
</div>
