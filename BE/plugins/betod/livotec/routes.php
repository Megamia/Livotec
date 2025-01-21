<?php

use Betod\Livotec\Models\Product;

Route::group(['prefix' => 'apiProduct'], function () {
    Route::get('products', function () {
        $product = Product::with(['image', 'category'])->get();
        return $product;
    });

    Route::get('products/{category_id}', function ($category_id) {
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products);
    });


    Route::get('products/{slug}', function ($slug) {
        $product = Product::with(['gallery', 'image', 'category'])->where('slug', $slug)->first();
        if ($product) {
            return $product;
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    });
});
