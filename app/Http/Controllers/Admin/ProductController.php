<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('parentCategory')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        return view('admin.products.create', compact('categories' , 'product'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'nullable',
            'quntity' => 'required|integer',
            'category_id' => 'required',
        ]);
        // store the image
        $new_image = rand() . rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $new_image);
        // save the product in database
        Product::create([
            'name' => $request->name,
            'image' => $new_image,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quntity' => $request->quntity,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.products.index')
            ->with('msg', 'Product successfully Added')
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        // get All Categories unless current category
        $categories = Category::where('id', '<>', $product->category_id)->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        // Validation
        $request->validate([
            'name' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
            'description' => 'nullable|string',
            'price' => 'nullable',
            'sale_price' => 'nullable',
            'quntity' => 'nullable',
            'category_id' => 'nullable',
        ]);
        //if the user dose not change thi image
        $new_image = $product->image;

        // if the user change the image
        if ($request->hasFile('image')) {
            // delete the old image
            $oldImagePath = public_path('uploads/images/' . $product->image);
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            // uploade a new image
            $new_image = uniqid() . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), $new_image);
        }
        // update the new image
        $product->update([
            'name' => $request->name,
            'image' => $new_image,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quntity' => $request->quntity,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.products.index')
            ->with('msg', 'Product updated successfully')
            ->with('type', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // to catch the product
        $product = Product::findOrFail($id);
        // to delete the pic
        if (file_exists(public_path('uploads/images/' . $product->image))) {
            File::delete(public_path('uploads/images/' . $product->image));
        }
        // to delete product from data base
        $product->delete();
        // redirect with massage
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted succssfully ')->with('type', 'danger');
    }
}
