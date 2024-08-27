<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index(){
        $products =Product::query()->where('soft_delete',0)->orderByDesc('id')->paginate(10);
        
        return view('admin.products.index',compact('products'));

    }
    public function create(){
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create',compact('brands','sizes','colors'));
    }
    public function store(Request $request){
        $data_product = [
        'code'=>$request['code'],
        'name'=>$request['name'],
        'slug'=>Str::slug($request['name']),
        'price'=>$request['price'],
        'sale_price'=>$request['sale_price'],
        'description'=>$request['description'],
        'material'=>$request['material'],
        'category_id'=>$request['category_id'],
        'brand_id'=>$request['brand_id'],
        ];
        // Ảnh sản phẩm
        $data_product['image'] = "";
        //nhập ảnh
        if( $request->hasFile('image')){
            $path = $request->file('image')->store('images');
            $data_product['image'] =$path; 
        }
        $product = Product::create($data_product);
        // xử lý biến thể
        dd($request['color_id']);
        for($i=0;$i<count($request['color_id']);$i++){
            $variant = [
                'product_id'=>$request->id,
                'color_id'=>$request['color_id'][$i],
               'size_id'=>$request['size_id'][$i],
               'quantity'=>$request['quantity'][$i],
               'image'=>$request['hinh'][$i]->store('images')
            ];
            ProductVariant::create($variant);
        }
        return redirect()->route('admin.products.index')->with('success','Thêm sản phẩm thành công');
    }
    public function edit(Product $product){
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.edit',compact('brands','sizes','colors','product'));
    }
    public function update(Request $request, Product $product){
        $data_product = [
            'code'=>$request['code'],
            'name'=>$request['name'],
            'slug'=>Str::slug($request['name']),
            'price'=>$request['price'],
            'sale_price'=>$request['sale_price'],
            'description'=>$request['description'],
            'material'=>$request['material'],
            'category_id'=>$request['category_id'],
            'brand_id'=>$request['brand_id'],
            ];
            // Ảnh sản phẩm
            $data_product['image'] = $product->image;
            //nhập ảnh nếu có
            if( $request->hasFile('image')){
                $path = $request->file('image')->store('images');
                $data_product['image'] =$path; 
            }
            $product->update($data_product);
            foreach($request['color_id'] as $index=>$color_id){
                $data_variant = [
                    'product_id' =>$product->id,
                    'color_id' =>$color_id,
                    'size_id'=>$request['size_id'][$index],
                    'quantity'=>$request['quantity'][$index],
                    'image'=>$request['hinh'][$index]->store('images')
                ];
                $find_variant = ProductVariant::query()
                ->where('product_id',$product->id)
                ->where('color_id',$color_id)
                ->where('size_id',$request['size_id'][$index])->first();
                // dd($data_variant);
                //update
                if($find_variant){
                    $find_variant->update($data_variant);// cập nhật
                }else{
                    ProductVariant::query()->create($data_variant);
                }
            }//end foreach
          
           
            return redirect()->back()->with('message','Cập nhật dữ liệu thành công');
    }
    public function destroy(Product $product){
        $product->update(['soft_delete'=>1]);
        return redirect()->back()->with('success','Xóa sản phẩm thành công');
    }
    

}
