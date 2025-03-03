<?php
use Illuminate\Http\Request;
use RainLab\User\Models\User;

Route::group(['prefix' => 'apiUser'], function () {
    Route::post('profile', function (Request $request) {
        $user = checkToken($request);
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }
        $data = User::with(['avatar'])->find($user->id);
        return response()->json($data);
    });
});

