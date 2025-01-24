<?php

use RainLab\Blog\Models\Post;

Route::group(['prefix' => 'apiProduct'], function () {
    Route::get('posts', function () {
        $post = Post::all();
        return $post;
    });
    Route::get('post/{slug}', function ($slug) {
        // Tìm bài viết theo slug
        $post = Post::where('slug', $slug)->first();

        if ($post) {
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    });
});