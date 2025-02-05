<?php

use Betod\Livotec\Models\Product;
use Betod\Livotec\Models\Category;

Route::group(['prefix' => 'apiProduct'], function () {
    Route::get('products', function () {
        $product = Product::with(['image', 'category'])->get();
        return $product;
    });

    Route::get('navProducts/{category_id}', function ($category_id) {
        $navProducts = Product::where('category_id', $category_id)->get();
        return response()->json($navProducts);
    });

    Route::get('product/{slug}', function ($slug) {
        $product = Product::with(['gallery', 'image', 'category', 'post'])->where('slug', $slug)->first();
        if ($product) {
            return $product;
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    });
});

Route::group(['prefix' => 'apiOrder'], function () {
    Route::post('createOrder', 'Betod\Livotec\Controllers\OrderController@createOrder');
});

Route::group(['prefix' => 'apiCategory'], function () {
    Route::get('category/{slug}', function ($slug) {
        $category = Category::with(['image'])->where('slug', $slug)->first();
        if ($category) {
            return $category;
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    });
});

