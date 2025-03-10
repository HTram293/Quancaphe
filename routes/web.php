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

Route::get('/vidu2','App\Http\Controllers\ViDuController@vidu2');
Route::post('/tinhtong','App\Http\Controllers\ViDuController@tinhtong');

Route::get("/qlsach/theloai","App\Http\Controllers\BookController@laythongtintheloai");
Route::get("/qlsach/thongtinsach","App\Http\Controllers\BookController@laythongtinsach");
Route::get("/qlsach/theloai","App\Http\Controllers\BookController@themtheloai");

Route::get('/add_category', 'App\Http\Controllers\CategoryController@create');
Route::post('/add-category', 'App\Http\Controllers\CategoryController@store');

Route::get('/add_categories', 'App\Http\Controllers\CategoryController@creates');
Route::post('/add_categories', 'App\Http\Controllers\CategoryController@stores');

Route::get('/trang1','App\Http\Controllers\ViduLayoutController@trang1');

Route::get('/sach','App\Http\Controllers\ViduLayoutController@sach');

Route::get('/sach/theloai/{id}','App\Http\Controllers\ViduController@theloai');

Route::get('/sach/chitiet/{id}','App\Http\Controllers\ViduLayoutController@chitiet');