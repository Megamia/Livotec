<?php

use Illuminate\Http\Request;
use Dat\Chatbot\Models\ChatBot;

Route::group(['prefix' => 'apiChatBot'], function () {

    Route::post('/learn', function (Request $request) {
        $message = $request->input('message', '');

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
                    'reply' => 'Câu hỏi và câu trả lời này đã tồn tại. Hãy nhập nội dung khác!',
                    'status' => 0,
                    'message' => 'Đã tồn tại'
                ], );
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
            \Log::error('Lỗi khi lưu dữ liệu chatbot: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã có lỗi xảy ra, vui lòng thử lại.'], 500);
        }
    });

    Route::post('/chat', function (Request $request) {
        try {
            $message = strtolower(trim($request->input('message', '')));

            if (empty($message)) {
                return response()->json(['reply' => 'Vui lòng nhập tin nhắn hợp lệ.'], 400);
            }

            if (str_starts_with($message, 'học:')) {
                $learnMessage = substr($message, 4);
                return response()->json(app()->handle(Request::create('/apiChatBot/learn', 'POST', ['message' => $learnMessage]))->getData());
            }

            $response = ChatBot::where('question', $message)->inRandomOrder()->first();

            if ($response) {
                return response()->json(['reply' => $response->answer]);
            }

            return response()->json(['reply' => 'Xin lỗi, tôi không biết câu trả lời. Hãy dạy tôi bằng "học: câu hỏi | câu trả lời".']);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong /chat API: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã xảy ra lỗi khi xử lý yêu cầu!'], 500);
        }
    });




    Route::get('/allChat', function () {
        $data = ChatBot::all();

        if ($data->isEmpty()) {
            return response()->json(['message' => "Không có dữ liệu"], 404);
        }

        return response()->json(['data' => $data]);
    });

});
