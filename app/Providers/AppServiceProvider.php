<?php

namespace App\Providers;

use App\Models\Cart;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // view()->composer(
        //     'layout.front',
        //     function ($view) {
        //         $cart = Cart::with('product')->where('cart_id' ,  App::make('cart.id'))->get();
        //         $view->with('carts', $cart );
        //     }
        // );
        // $carts = Cart::with('product')->where('cart_id' ,  App::make('cart.id'))->get();;
        // View::share('carts', $carts);
        // view()->share('carts' , $carts);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind('cart.id' , function(){
            $id = Cookie::get('cart_id');
            if(!$id)
            {
                $id = Str::uuid();
                Cookie::queue('cart_id' , $id , 60 * 24 * 30 );
            }
            return $id;
        });

        Paginator::useBootstrap();
    }
}
