<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $users = User::count();
        $categories = Category::count();
        $products = Product::count();
        $blogs = Blog::count();
        return view('admin.dashboard' ,
    [
        'users' =>  $users ,
        'categories'    =>  $categories ,
        'products'      =>  $products ,
        'blogs'         =>  $blogs ,
    ]);
    }
}
