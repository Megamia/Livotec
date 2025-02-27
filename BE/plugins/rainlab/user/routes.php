<?php

use RainLab\User\Models\User;

Route::group(['prefix' => 'apiUser'], function () {
    Route::get('profile', function () {
        $data = User::all();
        return $data;
    });
});
