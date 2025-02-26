<?php

use Betod\Livotec\Models\Product;
use Betod\Livotec\Models\Category;
use Betod\Livotec\Controllers\PayPalController;

Route::group(['prefix' => 'apiProduct'], function () {
    Route::get('products', function () {
        $product = Product::with(['image', 'category'])->get();
        return $product;
    });

    Route::get('navProducts/{slug}', function ($slug) {
        $category = Category::with(['children'])->where('slug', $slug)->first();

        $categoryIds = $category->getAllChildrenAndSelf()->pluck('id');
        $products = Product::with(['image', 'category'])
            ->whereIn('category_id', $categoryIds)
            ->get();

        return response()->json([
            'category' => $category,
            'products' => $products,
        ]);
    });

    Route::get('product/{slug}', function ($slug) {
        $product = Product::with(['gallery', 'image', 'category.parent', 'post'])->where('slug', $slug)->first();
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
    Route::get('category/{slug1}/{slug2?}', function ($slug1, $slug2 = null) {
        // Truy vấn category cha theo slug1
        $category = Category::with('image', 'filters')->where('slug', $slug1)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Nếu có slug2, tìm category con theo slug2
        if ($slug2) {
            $subCategory = $category->children()->with('image', 'filters')->where('slug', $slug2)->first();

            if (!$subCategory) {
                return response()->json(['message' => 'Sub-category not found'], 404);
            }

            // Chỉ lấy sản phẩm của category con
            $products = Product::with('image')
                ->where('category_id', $subCategory->id)
                ->get();

            return response()->json([
                'category' => $subCategory,
                'products' => $products,
            ]);
        }

        // Nếu không có slug2, lấy sản phẩm của category cha và các category con
        $categoryIds = $category->getAllChildrenAndSelf()->pluck('id');
        $products = Product::with('image')
            ->whereIn('category_id', $categoryIds)
            ->get();

        return response()->json([
            'category' => $category,
            'products' => $products,
        ]);
    });

    Route::get('allCategory', function () {
        $data = Category::all();
        if ($data) {
            return response()->json(['data1' => $data, 'status' => 1]);
        } else {
            return response()->json(['data1' => 'No data', 'status' => 0]);
        }
    });
    Route::get('allCategoryParent', function () {
        $allCategoryParent = Category::whereNull('parent_id')->get();

        if ($allCategoryParent->isNotEmpty()) {
            return response()->json(['allCategoryParent' => $allCategoryParent, 'status' => 1]);
        } else {
            return response()->json(['allCategoryParent' => 'No data', 'status' => 0]);
        }
    });
});

Route::group(['prefix' => 'apiPaypal'], function () {
    // Route để tạo đơn hàng
    Route::post('createOrder', [PayPalController::class, 'createOrder']);

    // Route để xác nhận thanh toán
    Route::post('captureOrder', [PayPalController::class, 'captureOrder']);
});
