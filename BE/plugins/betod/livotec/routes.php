<?php

use Betod\Livotec\Models\Product;

Route::group(['prefix' => 'apiProduct'], function () {
    Route::get('products', function () {
        $product = Product::with(['image', 'category'])->get();
        return $product;
    });

    Route::get('products/{category_slug}', function ($category_slug) {
        $products = Product::whereHas('category', function ($query) use ($category_slug) {
            $query->where('slug', $category_slug);
        })->get();
        return response()->json($products);
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
