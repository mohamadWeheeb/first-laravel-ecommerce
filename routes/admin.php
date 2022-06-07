<?php

use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
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

Route::middleware(['web' , 'chickUser:admin,super-admin' ])
            ->prefix('admin')
            ->group(function(){

    Route::get('notifications' , [NotificationController::class , 'index'])->name('notifications');
    Route::get('dashboard' , [DashboardController::class , 'index'])->name('admin.dashboard');
    Route::resource('users' , UsersController::class);
    Route::resource('products' , ProductsController::class);
    Route::resource('categories' , CategoriesController::class);
    Route::resource('blogs' , BlogsController::class);
    Route::resource('comments' , CommentsController::class);
    Route::resource('tags' , TagsController::class);
    Route::resource('contact' , ContactController::class);
    Route::resource('roles' , RolesController::class);
});
