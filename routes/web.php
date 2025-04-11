<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapheController;
use App\Http\Controllers\CapheLayoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VidumonController;

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

Route::get('/qlmon/loaimon', [CapheController::class, 'layloaimon']);
Route::get('/qlmon/thongtinmon', [CapheController::class, 'laythongtinmon']);
Route::get('/order', [CapheController::class, 'order'])->name('order');
Route::post('/cart/add', [CapheController::class, 'cartadd'])->name('cartadd');
Route::post('/cart/delete', [CapheController::class, 'cartdelete'])->name('cartdelete');
Route::post('/order/create', [CapheController::class, 'ordercreate'])->middleware('auth')->name('ordercreate');
Route::post('/productview', [CapheController::class, 'productview'])->name('productview');

Route::get('/trang1', [CapheLayoutController::class, 'trang1']);
Route::get('/mon', [CapheLayoutController::class, 'mon']);
Route::get('/mon/loaimon/{id}', [CapheLayoutController::class, 'loaimon']);
Route::get('/product/chitiet/{id}', [CapheLayoutController::class, 'chitiet']);

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

Route::get('/vidumon', [VidumonController::class, 'index']);

// JavaScript code for AJAX request
?>
<script>
$.ajax({
    type: "POST",
    dataType: "json",
    url: "{{ route('cartadd') }}",
    data: {
        _token: "{{ csrf_token() }}",
        id: id,
        num: num
    },
    success: function(data) {
        $("#cart-number-product").html(data);
    }
});
</script>

<input type="hidden" name="product_id" id="modal_product_id" value="">
