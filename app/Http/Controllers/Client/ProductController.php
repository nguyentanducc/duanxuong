<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug){
                //Lấy sản phẩm theo slug

        $product = Product::query()->where('slug', $slug)->firstOrFail();

        $variants = $product->variants; //Lấy ra biến thể của sản phẩm

        $colors = []; //Lấy ra chỉ màu sắc mà sản phẩm đó có
        foreach ($variants as $variant) {
            $colors[$variant->color->id] = $variant->color->name;
        }

        $sizes = []; //Lấy ra chỉ size mà sản phẩm đó có
        foreach ($variants as $variant) {
            $sizes[$variant->size->id] = $variant->size->name;
        }
        return view(
            'product-detail',
            compact('product', 'variants', 'colors', 'sizes')
        );
    }
}
