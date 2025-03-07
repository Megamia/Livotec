<?php

use Betod\Livotec\Models\Product;
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
            // ✅ 1. Chuẩn hóa tin nhắn người dùng
            $message = strtolower(trim($request->input('message', '')));
            if (empty($message)) {
                return response()->json(['reply' => 'Vui lòng nhập tin nhắn hợp lệ.'], 400);
            }

            // ✅ 2. Tìm kiếm sản phẩm theo từ khóa
            try {
                $keywords = explode(' ', $message);
                $product = Product::where(function ($query) use ($keywords) {
                    foreach ($keywords as $word) {
                        $query->orWhere('name', 'LIKE', "%$word%");
                    }
                })->first();

                if ($product) {
                    return response()->json([
                        'reply' => "Thông tin sản phẩm: {$product->name} - Giá: " . number_format($product->price ?? 0, 0, ',', '.') . " VNĐ. Còn lại: {$product->stock} cái."
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Lỗi khi tìm sản phẩm: ' . $e->getMessage());
            }

            // ✅ 3. Tìm kiếm danh mục sản phẩm
            try {
                $category = Product::whereIn('category', function ($query) use ($keywords) {
                    $query->select('category')
                        ->from('products')
                        ->where(function ($q) use ($keywords) {
                            foreach ($keywords as $word) {
                                $q->orWhere('category', 'LIKE', "%$word%");
                            }
                        });
                })->value('category');

                if (!empty($category)) {
                    $products = Product::where('category', $category)->take(3)->get();
                    if ($products->isNotEmpty()) {
                        $reply = "Dưới đây là một số sản phẩm trong danh mục $category:\n";
                        foreach ($products as $p) {
                            $reply .= "- {$p->name}, giá: " . number_format($p->price ?? 0, 0, ',', '.') . " VNĐ\n";
                        }
                        return response()->json(['reply' => $reply]);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Lỗi khi tìm danh mục sản phẩm: ' . $e->getMessage());
            }

            // ✅ 4. Tư vấn ngẫu nhiên nếu người dùng hỏi "tư vấn"
            if (str_contains($message, 'tư vấn')) {
                try {
                    $suggestedProduct = Product::inRandomOrder()->first();
                    if ($suggestedProduct) {
                        return response()->json([
                            'reply' => "Tôi đề xuất sản phẩm: {$suggestedProduct->name} - Giá: " . number_format($suggestedProduct->price ?? 0, 0, ',', '.') . " VNĐ."
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('Lỗi khi tư vấn sản phẩm: ' . $e->getMessage());
                }
            }

            // ✅ 5. Kiểm tra trong chatbot database
            try {
                $response = ChatBot::where('question', $message)->inRandomOrder()->first();
                if (!empty($response)) {
                    return response()->json(['reply' => $response->answer]);
                }
            } catch (\Exception $e) {
                \Log::error('Lỗi khi tìm dữ liệu chatbot: ' . $e->getMessage());
            }

            // ✅ 6. Gọi Google Gemini API nếu không tìm thấy dữ liệu
            try {
                $client = new Client();
                $gemini_api_key = env('GEMINI_API_KEY');

                $res = $client->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$gemini_api_key", [
                    'headers' => ['Content-Type' => 'application/json'],
                    'json' => ['contents' => [['parts' => [['text' => $message]]]]]
                ]);

                $responseData = json_decode($res->getBody(), true);

                // ✅ Kiểm tra nếu API trả về dữ liệu hợp lệ
                if (!empty($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $responseData['candidates'][0]['content']['parts'][0]['text'];
                } else {
                    $reply = 'Xin lỗi, tôi không có câu trả lời.';
                }

                return response()->json(['reply' => $reply]);

            } catch (\Exception $e) {
                \Log::error('Lỗi API Google Gemini: ' . $e->getMessage());
                return response()->json(['reply' => 'Đã xảy ra lỗi khi xử lý yêu cầu!'], 500);
            }

        } catch (\Exception $e) {
            \Log::error('Lỗi không xác định trong chatbot: ' . $e->getMessage());
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
