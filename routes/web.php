<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\Website\HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});
Route::controller(App\Http\Controllers\Website\ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/{slug}', 'show')->name('product.show');
});
Route::controller(App\Http\Controllers\Website\ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
});

// User
Route::middleware('auth')->group(function () {
    Route::controller(App\Http\Controllers\Website\CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/store', 'store')->name('cart.store');
        Route::post('/cart/update', 'update')->name('cart.update');
        Route::delete('/cart/delete/{cart}', 'delete')->name('cart.delete');
    });
    Route::controller(App\Http\Controllers\Website\CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout/store', 'store')->name('checkout.store');
    });
    Route::controller(App\Http\Controllers\Website\OrderController::class)->group(function () {
        Route::get('/order', 'index')->name('order.index');
        Route::post('order/payment-confirm/{order}', 'paymentConfirm')->name('order.payment-confirm');
        Route::post('order/cancel/{order}', 'cancel')->name('order.cancel');
        Route::post('order/receipt/{order}', 'receipt')->name('order.receipt');
    });
    Route::controller(App\Http\Controllers\Website\WishlistController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('wishlist.index');
        Route::post('/wishlist/store', 'store')->name('wishlist.store');
        Route::delete('/wishlist/delete/{wishlist}', 'delete')->name('wishlist.delete');
    });
});

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'can:auth-admin']], function () {
    Route::controller(App\Http\Controllers\Admin\HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->except(['destroy', 'show']);
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::resource('/brand', App\Http\Controllers\Admin\BrandController::class)->except(['destroy', 'show']);
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class)->except(['destroy', 'show']);
    });
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class)->except(['destroy']);
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/order', 'index')->name('order.index');
        Route::get('/order/show/{order}', 'show')->name('order.show');
        Route::post('/order/status/{order}', 'status')->name('order.status');
    });
    Route::controller(App\Http\Controllers\Admin\ReportController::class)->group(function () {
        Route::get('/report', 'index')->name('report.index');
        Route::get('/report/filter', 'filter')->name('report.filter');
        Route::get('/report/pdf-report-order', 'pdfReportOrder')->name('report.pdf-report-order');
    });
});

Route::controller(App\Http\Controllers\FileController::class)->group(function () {
    Route::get('/file/show/{file_path}/{file_name}', 'show')->name('file.show');
});

Route::controller(App\Http\Controllers\AjaxController::class)->group(function () {
    Route::get('/ajax/product-variant-qty', 'productVariantQty')->name('ajax.product-variant.qty');
});

Auth::routes();
