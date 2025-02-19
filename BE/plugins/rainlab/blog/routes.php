<?php
use RainLab\Blog\Models\Post;

Route::group(['prefix' => 'apiPost'], function () {
    Route::get('post/{slug}', function ($slug) {
        $post = Post::with(['categories','user'])->where('slug', $slug)->first();
        return $post;
    });
});