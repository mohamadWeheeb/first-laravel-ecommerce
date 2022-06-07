<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CartegoriesController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' , [FrontController::class , 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('categories/{slug}' , [CartegoriesController::class , 'show'])->name('categories.view');
Route::get('products/{slug}' , [ProductsController::class , 'show'])->name('products.view');
Route::post('cart', [CartController::class , 'store'])->name('cart');
Route::get('cart', [CartController::class , 'index']);

Route::post('checkout', [CheckoutController::class , 'store'])->name('checkout');
Route::get('checkout', [CheckoutController::class , 'index']);
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
