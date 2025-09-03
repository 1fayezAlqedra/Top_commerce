<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::with('products' , 'parent')->withCount('Products')->orderBy('id', 'desc')->paginate(10);
        // dd($Categories);
        return view('admin.categories.index', compact('Categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
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
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        //upload the File
        $new_image = rand() . rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $new_image);
        // save data in DataBase
        Category::create([
            'name' => $request->name,
            'image' => $new_image,
            'parent_id' => $request->parent_id
        ]);
        return redirect()->route('admin.categories.index')->with('msg', 'Category Created ')
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
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->where('id', '<>', $category->id)->get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // جلب التصنيف من قاعدة البيانات
        $category = Category::findOrFail($id);

        // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        // If the User dosent change the Old image
        $new_image = $category->image;

        // if the user updated the image
        if ($request->hasFile('image')) {
            // delete the old imag from Data Base
            $oldImagePath = public_path('uploads/images/' . $category->image);
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Make a new image for the image and upload it into data Base
            $new_image = uniqid() . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), $new_image);
        }

        // Update the Data Base
        $category->update([
            'name' => $request->name,
            'image' => $new_image,
            'parent_id' => $request->parent_id,
        ]);

        // redirect to index page and send Massage
        return redirect()->route('admin.categories.index')
            ->with('msg', 'Category updated successfully')
            ->with('type', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // to find the category needed to delete
        $category = Category::findOrFail($id);
        // to delete an image
        if (file_exists(public_path('uploads/images/' . $category->image))) {
            File::delete(public_path('uploads/images/' . $category->image));
        }

        // set parent id to null
        Category::where('parent_id', $category->id)->update(['parent_id' => null]);

        //  to delete item
        $category->delete();

        // return
        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted')
            ->with('type', 'danger');
    }
}
