<?php
namespace Betod\Livotec\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Betod\Livotec\Models\Orders;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'diffname' => 'nullable|string|max:255',
            'diffphone' => 'nullable|string|max:20',
            'diffprovince' => 'nullable|string|max:255',
            'diffdistrict' => 'nullable|string|max:255',
            'diffsubdistrict' => 'nullable|string|max:255',
            'diffaddress' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'terms' => 'required|boolean',
            'paymenttype' => 'required|integer',
            'differentaddresschecked' => 'required|boolean',
        ]);

        // Chuyển dữ liệu thành JSON trước khi lưu vào cột text
        $order = Orders::create([
            'user_id' => $validatedData['user_id'],
            'property' => $validatedData,
        ]);

        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order
        ], 201);
    }
}