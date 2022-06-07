<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{


    public function index()
    {
        $carts = Cart::with('product')->where('cart_id' ,  App::make('cart.id'))->get();
        $totle_price = $carts->sum(function($items){
            return $items->product->price * $items->quantity ;
        });

        $countries = Countries::getNames('AR');
        return view('front.products.checkout' ,[
            'carts' =>  $carts ,
            'totle_price' =>  $totle_price ,
            'countries' =>  $countries ,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate(
            [
                'first_name'    =>  'required|string' ,
                'last_name'    =>  'required|string' ,
                'email'         =>  'required|email' ,
                'phone'         =>  'required' ,
                'address'         =>  'required' ,
                'city'         =>  'required' ,
            ]
        );

        $carts = Cart::with('product')->where('cart_id' ,  App::make('cart.id'))->get();
        $totle_price = $carts->sum(function($items){
            return $items->product->price * $items->quantity ;
        });

        if($carts->count() == 0)
        {
            return redirect('/');
        }


        DB::beginTransaction();

        try{
            if($request->post('regester'))
            {
                //  $user = $this->CreateUser($request);
            }
            $request->merge([
                'user_id'   =>  Auth::check() ? Auth::id() : null  ,
                'totle'     =>  $totle_price ,
            ]);
            $order = Order::create($request->all());

            foreach($carts as $item)
            {
                $order->items()->create([
                    'product_id'    =>  $item->product->id ,
                    'price'      =>  $item->product->price ,
                    'quantity'      =>  $item->quantity ,
                ]);
            }

            Cart::where('cart_id' ,  App::make('cart.id'))->delete();
            DB::commit();
            $user = User::where('type' , '=' ,'super-admin')->first();
            $user->notify(new NewOrderCreatedNotification($order));
            return redirect('/')->with('success' , 'Thank You, Your Order Hass Been Created !');
        } catch(Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error' , $e->getMessage());
        }

    }


    // protected function createUser(Request $request)
    // {
    //     $user = new User();
    //     $data = [
    //         'name'  =>  $request->first_name . ' ' . $request->last_name ,
    //         'email' =>  $request->email ,
    //         'password'  =>  12345678 ,
    //     ];
    //     $user->create($data);
    //     return $user;
    // }
}
