<?php

use RainLab\Blog\Models\Post;

Route::group(['prefix' => 'apiPost'], function () {
    Route::get('post/{slug}', function ($slug) {
        $post = Post::with(['categories', 'user'])->where('slug', $slug)->first();
        return $post;
    });
    Route::get('hotNews/{slugCategory}', function ($slugCategory) {
        $hotNews = Post::with('categories')
            ->whereHas('categories', function ($query) use ($slugCategory) {
                $query->where('slug', $slugCategory);
            })
            ->get();

        return response()->json($hotNews);
    });
});
