<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/chat', ChatController::class);

Route::get('/commodity', 'App\Http\Controllers\MainController@commodity');
Route::get('/confirm', 'App\Http\Controllers\MainController@confirm');
Route::get('/carts', 'App\Http\Controllers\MainController@carts');
Route::get('/purchases', 'App\Http\Controllers\MainController@purchases');
Route::get('/cartDeleate', 'App\Http\Controllers\MainController@cartDeleate');
Route::get('/cartDeleates', 'App\Http\Controllers\MainController@cartDeleates');
Route::get('/changeCart', 'App\Http\Controllers\MainController@changeCart');
Route::get('/updateCart', 'App\Http\Controllers\MainController@updateCart');
Route::get('/sendContact', 'App\Http\Controllers\MainController@sendContact');
Route::get('/contactconfirm', 'App\Http\Controllers\MainController@contactconfirm');
Route::get('/Items',  function () {
    return view('items');
});
Route::get('/contact',  function () {
    return view('contact');
});
Route::get('/inquiryList', 'App\Http\Controllers\MainController@inquiryList');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/admin/login', 'App\Http\Controllers\admin\LoginController@showLoginForm');
Route::post('/admin/login', 'App\Http\Controllers\admin\LoginController@login');
Route::post('admin/logout',  'App\Http\Controllers\admin\LoginController@logout')->name('admin.logout');
Route::get('/admin/register', 'App\Http\Controllers\admin\registerController@showRegistrationForm')->name('admin.register');
Route::post('/admin/register', 'App\Http\Controllers\admin\registerController@register');

Route::get('/{any}', function () {
    return view('top');
})->where('any', '.*');