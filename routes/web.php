<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/commodity', 'App\Http\Controllers\MainController@commodity');
Route::get('/confirm', 'App\Http\Controllers\MainController@confirm');
Route::get('/carts', 'App\Http\Controllers\MainController@carts');
Route::get('/purchases', 'App\Http\Controllers\MainController@purchases');
Route::get('/cartDeleate', 'App\Http\Controllers\MainController@cartDeleate');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/{any}', function () {
    return view('top');
})->where('any', '.*');