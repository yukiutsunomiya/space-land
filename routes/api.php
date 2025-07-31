<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

//Route::get('login', LoginController::class)->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LogoutController::class,'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'create']);
Route::post('/admin/login', [AdminLoginController::class,'login']);
Route::post('/admin/register', [AdminRegisterController::class, 'create']);


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
//Route::get('/confirm', [MainController::class, 'confirm']); 

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/confirm', [MainController::class, 'confirm']); 
    Route::get('/carts', [MainController::class, 'carts']); 
    Route::get('/purchases', [MainController::class, 'purchases']); 
    Route::get('/cartDelete', [MainController::class, 'cartDelete']); 
    Route::get('/cartDeletes', [MainController::class, 'cartDeletes']);
    Route::get('/updateCart', [MainController::class, 'updateCart']); 
    Route::get('/inquiryList', [MainController::class, 'inquiryList']); 
    Route::get('/inquiry', [MainController::class, 'inquiry']); 
    Route::post('/userUpdate', [MainController::class, 'userUpdate']); 
});
Route::post('/userDelete', [MainController::class, 'userDelete']); 
Route::get('/items', 'App\Http\Controllers\MainController@index');
Route::get('/online-store', 'App\Http\Controllers\MainController@index');
Route::get('/item', 'App\Http\Controllers\MainController@select');
Route::get('/commodity', 'App\Http\Controllers\MainController@select');
Route::get('/sendContact', [MainController::class, 'sendContact']); 

Route::middleware(['auth:admin'])->group(function () {
    Route::post('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/user', [AdminController::class, 'user']);
    Route::post('/admin/userEdit', [AdminController::class, 'userEdit']);
    Route::post('/admin/userUpdate', [AdminController::class, 'userUpdate']);
    Route::post('/admin/userPurchases', [AdminController::class, 'userPurchases']);
    Route::post('/admin/userOrderHistory', [AdminController::class, 'userOrderHistory']);
    Route::post('/admin/shipUpdate', [AdminController::class, 'shipUpdate']);
    Route::post('/admin/userCart', [AdminController::class, 'userCart']);
    Route::post('/admin/userInquiryList', [AdminController::class, 'userInquiryList']);
    Route::post('/admin/userInquiry', [AdminController::class, 'userInquiry']);
    Route::post('/admin/situationUpdate', [AdminController::class, 'situationUpdate']);
    Route::post('/admin/orderHistory', [AdminController::class, 'orderHistory']);
    Route::post('/admin/InquiryList', [AdminController::class, 'InquiryList']);
    Route::post('/admin/Inquiry', [AdminController::class, 'Inquiry']);
    Route::post('/admin/product', [AdminController::class, 'product']);
});