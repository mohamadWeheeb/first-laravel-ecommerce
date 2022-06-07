<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cart_id = App::make('cart.id');
        $carts = Cart::with('product')->where('cart_id' ,  $cart_id)->get();
        $totle_price = $carts->sum(function($items){
            return $items->product->price * $items->quantity ;
        });

        return view('front.products.cart' ,
    [
        'carts'  =>    $carts ,
        'totle_price'   =>  $totle_price ,
    ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'    =>  'required|exists:products,id' ,
            'quantity'      =>  'integer|min:1' ,

        ]);
        $product_id = $request->post('product_id');
        $quantity  = $request->post('quantity' , 1);
        $cart_id = App::make('cart.id');
        $cart = Cart::where(
            [
                'product_id'    =>  $request->post('product_id') ,
                'cart_id'       =>  $cart_id  ,
            ]
        )->first();
            if($cart)
            {
                $cart->increment('quantity' ,$quantity);
            }
            else
            {
                $cart = Cart::create([
                    'product_id'    =>  $product_id ,
                    'user_id'       =>  Auth::id() ,
                    'cart_id'       =>  $cart_id  ,
                    'quantity'      =>  $quantity ,

                ]);
            }
        $product = Product::where('id' , $product_id)->first();

        return redirect()->back()->with('success' , " Product ' $product->name ' Added to Cart ");
    }




}
