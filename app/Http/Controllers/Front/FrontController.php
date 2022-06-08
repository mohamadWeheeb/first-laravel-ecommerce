<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Services\GeoIP\MaxMindGeoLite;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // free Api
        // $config = config('services.maxmind');
        // $geoip = new MaxMindGeoLite($config['account_id'] , $config['License_key']);
        // $country = $geoip->country('156.192.157.189');
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
