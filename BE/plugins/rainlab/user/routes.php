<?php
use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Support\Facades\Hash;

Route::group(['prefix' => 'apiUser'], function () {
    Route::post('profile', function (Request $request) {
        $user = checkToken($request);
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }
        $data = User::with(['avatar'])->find($user->id);
        return response()->json($data);
    });
    Route::post('user', function (Request $request) {
        $user = checkToken($request);
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }
        $data = User::with(['avatar'])->find($user->id);
        $userdata = [
            'id' => $data->id,
            'first_name' => $data->first_name,
            'avatar_preview' => $data->avatar_url,
        ];
        return response()->json($userdata);
    });
    Route::post('/change-password', function (Request $request) {
        $user = checkToken($request);
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }
        $validated = $request->validate([
            'old_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',  // Ít nhất 8 ký tự
                'regex:/[A-Z]/', // Ít nhất một chữ hoa
                'regex:/[a-z]/', // Ít nhất một chữ thường
                'regex:/[0-9]/', // Ít nhất một số
                function ($attribute, $value, $fail) use ($request, $user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('Mật khẩu mới không được trùng với mật khẩu cũ.');
                    }
                },
            ],
        ]);
        // Kiểm tra mật khẩu cũ
        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác!'], 422);
        }
        // Cập nhật mật khẩu mới
        // $user->password = Hash::make($validated['new_password']);
        // $user->save();
        // // Ghi log sự kiện đổi mật khẩu
        // \Log::info("User ID {$user->id} đã đổi mật khẩu.", ['user_id' => $user->id]);
        \Log::info('Hashed Password Before Save: ' . Hash::make($validated['new_password']));
        $user->password = $validated['new_password'];
        $user->save();
        \Log::info('Hashed Password After Save: ' . $user->password);
        return response()->json([
            'message' => 'Đổi mật khẩu thành công!',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'updated_at' => $user->updated_at,
            ],
        ]);
    });
});

