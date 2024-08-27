<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $product8 = Product::query()->orderByDesc('id')->limit(8)->get();
        return view('home',compact('product8'));
    }
}
