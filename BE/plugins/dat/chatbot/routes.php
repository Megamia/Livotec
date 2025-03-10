<?php

use Illuminate\Http\Request;
use Dat\Chatbot\Models\ChatBot;
use Illuminate\Support\Facades\Log;
require_once __DIR__ . '/functionChatBot.php';


Route::group(['prefix' => 'apiChatBot'], function () {

    // **1. API học câu hỏi**
    Route::post('/learn', function (Request $request) {
        $message = trim($request->input('message', ''));

        if (empty($message)) {
            return response()->json(['reply' => 'Vui lòng nhập nội dung hợp lệ.'], 400);
        }

        $data = explode('|', $message);

        if (count($data) !== 2) {
            return response()->json(['reply' => 'Sai định dạng! Hãy gửi: "học: câu hỏi | câu trả lời".'], 400);
        }

        $question = strtolower(trim($data[0]));
        $answer = trim($data[1]);

        try {
            $existingChat = ChatBot::where('question', $question)
                ->where('answer', $answer)
                ->first();

            if ($existingChat) {
                return response()->json([
                    'reply' => 'Câu hỏi và câu trả lời này đã tồn tại.',
                    'status' => 0,
                    'message' => 'Đã tồn tại'
                ]);
            }

            ChatBot::create([
                'question' => $question,
                'answer' => $answer
            ]);

            return response()->json([
                'reply' => 'Tôi đã học câu mới: ' . implode(' | ', [$question, $answer]),
                'status' => 1,
                'message' => 'Tạo dữ liệu mới'
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi lưu dữ liệu chatbot: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã có lỗi xảy ra, vui lòng thử lại.'], 500);
        }
    });

    // **2. API chat với chatbot**
    Route::post('/chat', function (Request $request) {
        $message = strtolower(trim($request->input('message', '')));
        if (empty($message)) {
            return response()->json(['reply' => 'Vui lòng nhập tin nhắn hợp lệ.'], 400);
        }

        // Kiểm tra câu trả lời có sẵn trong database
        $chatResponse = ChatBot::where('question', $message)->inRandomOrder()->first();
        if ($chatResponse) {
            return response()->json(['reply' => $chatResponse->answer]);
        }

        // Xử lý yêu cầu tư vấn sản phẩm
        if (str_starts_with($message, 'tư vấn')) {
            return handleProductAdvice($message);
        }

        // Gọi API AI nếu không có câu trả lời sẵn
        return callGeminiAPI($message);
    });

    // **3. API lấy toàn bộ dữ liệu chatbot**
    Route::get('/allChat', function () {
        $data = ChatBot::all();

        if ($data->isEmpty()) {
            return response()->json(['message' => "Không có dữ liệu"], 404);
        }

        return response()->json(['data' => $data]);
    });

});
