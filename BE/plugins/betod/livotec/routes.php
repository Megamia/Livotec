<?php

use Betod\Livotec\Models\Product;

Route::group(['prefix' => 'api'], function () {
    Route::get('products', function () {
        $product = Product::with(['image','category'])->get();
        return $product;
    });
});