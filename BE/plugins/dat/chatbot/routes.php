<?php

use Betod\Livotec\Models\Category;
use Betod\Livotec\Models\Product;
use Illuminate\Http\Request;
use Dat\Chatbot\Models\ChatBot;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
        try {
            $message = strtolower(trim($request->input('message', '')));

            if (empty($message)) {
                return response()->json(['reply' => 'Vui lòng nhập tin nhắn hợp lệ.'], 400);
            }

            // **1️⃣ Kiểm tra xem câu hỏi đã được học trong database chưa**
            $chatResponse = ChatBot::where('question', $message)->inRandomOrder()->first();
            if ($chatResponse) {
                return response()->json(['reply' => $chatResponse->answer]);
            }

            // **2️⃣ Nếu tin nhắn bắt đầu bằng "Tư vấn", tìm kiếm sản phẩm**
            if (str_starts_with($message, 'tư vấn')) {
                $keyword = str_replace('tư vấn', '', $message);
                $keyword = trim($keyword);

                if (!empty($keyword)) {
                    // Kiểm tra nếu từ khóa là một category_id hợp lệ
                    $category = Category::where('name', 'LIKE', "%$keyword%")->first();

                    // Nếu tìm thấy danh mục, lấy category_id
                    if ($category) {
                        $products = Product::where('category_id', $category->id)->get();
                    } else {
                        // Nếu không, tìm theo tên sản phẩm
                        $products = Product::where('name', 'LIKE', "%$keyword%")->get();
                    }

                    if ($products->isNotEmpty()) {
                        $reply = "🔍 Danh sách sản phẩm phù hợp:\n";
                        $index = 1;
                        foreach ($products as $product) {
                            $reply .= "{$index}. {$product->name}\n";
                            $reply .= "💰 Giá: " . ($product->price ?? 0) . " VNĐ\n";
                            $reply .= "📦 Số lượng còn: {$product->stock} cái.\n";
                            $reply .= "===================================\n";
                            $index++;
                        }
                        return response()->json(['reply' => $reply]);
                    }
                }

                return response()->json(['reply' => 'Xin lỗi, tôi không tìm thấy sản phẩm phù hợp.']);
            }


            // **3️⃣ Nếu không có trong database và không phải sản phẩm -> Gọi AI**
            $gemini_api_key = env('GEMINI_API_KEY');

            if (!$gemini_api_key) {
                return response()->json(['reply' => 'Chưa cấu hình API AI.'], 500);
            }

            $client = new Client();

            try {
                $res = $client->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$gemini_api_key", [
                    'headers' => ['Content-Type' => 'application/json'],
                    'json' => ['contents' => [['parts' => [['text' => $message]]]]]
                ]);

                $responseData = json_decode($res->getBody(), true);

                $reply = 'Xin lỗi, tôi không có câu trả lời.';
                if (!empty($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $responseData['candidates'][0]['content']['parts'][0]['text'];
                }

                return response()->json(['reply' => $reply]);
            } catch (\Exception $e) {
                Log::error('Lỗi khi gọi API Gemini: ' . $e->getMessage());
                return response()->json(['reply' => 'Xin lỗi, AI đang gặp sự cố. Vui lòng thử lại sau.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi API chatbot: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã xảy ra lỗi khi xử lý yêu cầu!'], 500);
        }
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
