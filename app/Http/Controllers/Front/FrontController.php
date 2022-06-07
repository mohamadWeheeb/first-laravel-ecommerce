<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $latestCategories = Category::latest()->limit(7)->get(['slug' , 'name']);
        $latestProducts = Product::with('category')->latest()->paginate();
        $tags = Tag::all();

        return view('front.index' , [
            'latestCategories'    =>  $latestCategories ,
            'latestProducts'  =>  $latestProducts ,
            'tags'      =>  $tags ,
        ]);
    }
}
