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


Route::get('/', function () {
   return view('welcome');
});


Route::get("/qlmon/loaimon","App\Http\Controllers\CapheController@layloaimon");
Route::get("/qlmon/thongtinmon","App\Http\Controllers\CapheController@laythongtinmon");
Route::get('/trang1','App\Http\Controllers\CapheLayoutController@trang1');
Route::get('/mon','App\Http\Controllers\CapheLayoutController@mon');
Route::get('/mon/loaimon/{id}','App\Http\Controllers\CapheLayoutController@loaimon');
Route::get('/product/chitiet/{id}','App\Http\Controllers\CapheLayoutController@chitiet');
Route::get('/order','App\Http\Controllers\CapheController@order')->name('order');
Route::post('/cart/add','App\Http\Controllers\CapheController@cartadd')->name('cartadd');
Route::post('/cart/delete','App\Http\Controllers\CapheController@cartdelete')->name('cartdelete');
Route::post('/order/create','App\Http\Controllers\CapheController@ordercreate')
->middleware('auth')->name('ordercreate');
Route::post('/productview','App\Http\Controllers\CapheController@productview')->name("productview");
