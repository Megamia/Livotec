<?php

use Illuminate\Http\Request;
use Dat\Chatbot\Models\ChatBot;
use GuzzleHttp\Client;

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

            $response = ChatBot::where('question', $message)->inRandomOrder()->first();
            if ($response) {
                return response()->json(['reply' => $response->answer]);
            }

            $client = new Client();
            $huggingface_api_key = env('HUGGINGFACE_API_KEY');
            $res = $client->post('https://api-inference.huggingface.co/models/facebook/blenderbot-400M-distill', [
                'headers' => [
                    'Authorization' => "Bearer $huggingface_api_key",
                    'Content-Type' => 'application/json'
                ],
                'json' => ['inputs' => $message]
            ]);

            $responseData = json_decode($res->getBody(), true);
            $reply = $responseData[0]['generated_text'] ?? 'Xin lỗi, tôi không có câu trả lời.';

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            \Log::error('Lỗi Hugging Face API: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã xảy ra lỗi khi xử lý yêu cầu!' . $e->getMessage()], 500);
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
