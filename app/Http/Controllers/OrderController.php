<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {

        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $payment = 'Thanh toán trực tiếp';
        $status = 'Đơn mới';
        $carts = session('cart');
        $total_money = 0;
        foreach ($carts as $cart) {
            $total_money += ($cart['sale_price'] ?? $cart['price']) * $cart['quantity'];
        }

        $order = Order::query()->create([
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'payment' => $payment,
            'status' => $status,
            'total_money' => $total_money,
        ]);

        //Thêm dữ liệu vào order_detail
        foreach ($carts as $cart) {
            OrderDetail::query()->create([
                'order_id' => $order->id,
                'variant_id' => $cart['variant_id'],
                'price' => $cart['sale_price'] ?? $cart['price'],
                'quantity' => $cart['quantity'],
                'unit_price' => ($cart['sale_price'] ?? $cart['price']) * $cart['quantity']
            ]);
        }

        //Xóa giỏ hàng
        session()->forget('cart');
        return "Đặt hàng thành công";
    }
}