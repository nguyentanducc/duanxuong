<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //thêm sản phẩm vài giỏ hàng
    public function addToCart(Request $request)
    {
        //Nếu có giỏ hàng thì lưu lại, còn không thì tạo mới
        $cart = session('cart') ?? [];
        // dd($request->all());
        //lấy thông tin hàng hóa
        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = $request->input('quantity');

        //lấy variantion
        $variant = ProductVariant::query()
            ->where('product_id', $product_id)
            ->where('color_id',  $color)
            ->where('size_id', $size)
            ->first();

        if ($variant == null) {
            return redirect()->back()->with('cartFail', 'Sản phẩm không còn hàng');
        }

        $product = [
            'variant_id' => $variant->id,
            'product_name' => $variant->product->name,
            'image' => $variant->product->image,
            'price' => $variant->product->price,
            'sale_price' => $variant->product->sale_price,
            'color' => $variant->color->name,
            'size' => $variant->size->name,
            'quantity' => $quantity,
        ];

        //Kiểm tra xem sản phẩm đã trong giỏ hàng chưa
        if (isset($cart[$variant->id])) {
            $cart[$variant->id]['quantity'] += $quantity;
        } else {
            $cart[$variant->id] = $product;
        }

        session()->put('cart', $cart);

        return redirect()->route('page.cart'); //view cart
    }

    public function index()
    {
        $carts = session('cart') ?? [];

        return view('cart', compact('carts'));
    }

    public function viewCheckOut()
    {
        return view('checkout');
    }
}