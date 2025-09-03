<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use PHPUnit\Framework\Attributes\Group;
Route::get('/test', function () {
    return __('site.Home');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);

    });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('web.index');
Route::get('/category/{id}', [App\Http\Controllers\SiteController::class, 'category'])->name('web.category');
Route::get('/product/{id}', [App\Http\Controllers\SiteController::class, 'product'])->name('web.product');
Route::get('/contact', [App\Http\Controllers\SiteController::class, 'contact'])->name('web.contact');
// cart operations route

Route::middleware('auth')->group(function () {

    Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('add-to-cart');
    Route::get('remove-cart/{id}', [CartController::class, 'remove_cart'])->name('remove_cart');
    Route::get('/cart', [CartController::class, 'cart'])->name('web.cart');
    Route::get('/shop', [CartController::class, 'shop'])->name('web.shop');
    Route::post('/update-cart', [CartController::class, 'update_cart'])->name('web.update_cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('web.checkout');
    Route::get('/checkout/thanks', [CartController::class, 'checkout_thanks'])->name('web.checkout_thanks');
    Route::post('/add-review', [SiteController::class, 'add_review'])->name('web.add_review');

});

