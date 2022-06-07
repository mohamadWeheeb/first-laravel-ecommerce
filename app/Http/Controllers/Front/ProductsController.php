<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('category')->where('slug' ,$slug)->firstOrFail();
        $likeProducts = Product::where('category_id' , '=' , $product->category_id)->get();
        return view('front.products.show' ,
    [
        'product'   =>  $product ,
        'likeProducts' =>  $likeProducts ,
    ]);
    }
}
