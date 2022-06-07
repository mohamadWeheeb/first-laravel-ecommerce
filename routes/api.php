<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('products' , ProductsController::class);
Route::post('login' , [LoginController::class , 'login']);
Route::post('logout' , [LogoutController::class , 'logoutFromCurrentDevice'])->middleware('auth:sanctum');
Route::post('logout-from-all-devices' , [LogoutController::class , 'logoutFromAllDevices'])->middleware('auth:sanctum');
