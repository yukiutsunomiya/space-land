<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/items', 'App\Http\Controllers\MainController@index');
Route::get('/online-store', 'App\Http\Controllers\MainController@index');
Route::get('/item', 'App\Http\Controllers\MainController@select');
Route::get('/commodity', 'App\Http\Controllers\MainController@select');
