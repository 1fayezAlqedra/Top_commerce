<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    function index()
    {
        $main_categories = Category::with('children')->whereNull('parent_id')->take(11)->get();
        $latest_products = Product::with('parentCategory')->orderByDesc('created_at')->limit(3)->get();
        return view('web.index', compact('main_categories', 'latest_products'));
    }
    function category($id)
    {
        $category = Category::findOrFail($id);
        return view('web.category', compact('category'));
    }
    function product($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        return view('web.product', compact('product'));
    }
    function contact()
    {
        return view('web.contact');
    }


    function add_review(Request $request)
    {
        Review::create([
            'user_id' => Auth::id(),
            'content' => $request->rev_content,
            'product_id' => $request->product_id,
            'stars' => $request->stars,
        ]);
        return redirect()->back();
    }
}

