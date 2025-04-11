<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Table;
use App\Models\BookingTable;
use Carbon\Carbon;

use App\Http\Controllers\CapheController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CapheController extends Controller{

function layloaimon(){
$loai_mon = Category::all();
return view("qlmon.loai_mon",compact("loai_mon"));
}
function laythongtinmon(){
$products = Product::where("category","Cà phê")->get();
 return view("qlmon.thong_tin_mon",compact("products"));
}
function loaimon($id)
{
$data = DB::select("select * from products where categories = ?",[$id]);
return view("vidumon.index", compact("data"));
}
public function cartadd(Request $request)
    {
        $request->validate(["id"=>["required","numeric"],"num"=>["required","numeric"]]);
        $id = $request->id;
        $num = $request->num;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
    {
        $cart = session()->get("cart");
        if(isset($cart[$id]))
        $cart[$id] += $num;
    else
        $cart[$id] = $num ;
    }
    else
    {
        $cart[$id] = $num ;
    }
        session()->put("cart",$cart);
        return count($cart);
    }

public function order()
    {
        $cart = [];
        $data = [];
        $quantity = [];
    
        // Lấy dữ liệu giỏ hàng
        if (session()->has('cart')) {
            $cart = session("cart");
            $list_product = "";
            foreach ($cart as $id => $value) {
                $quantity[$id] = $value;
                $list_product .= $id . ", ";
            }
    
            $list_product = rtrim($list_product, ", ");
            if ($list_product != "")
                $data = DB::table("products")->whereRaw("id in ($list_product)")->get();
            else
                $data = [];
        }
    
        // Lấy dữ liệu đặt bàn
        $bookingData = session('booking_data');
    
        return view('vidumon.order', [
            'data' => $data,
            'quantities' => $quantity,
            'bookingData' => $bookingData
        ]);
    }
    
public function cartdelete(Request $request)
{
$request->validate([
"id"=>["required","numeric"]
]);
$id = $request->id;
$total = 0;
$cart = [];
if(session()->has('cart'))
{
$cart = session()->get("cart");
unset($cart[$id]);
}
session()->put("cart",$cart);
return redirect()->route('order');
}

public function ordercreate(Request $request)
{
$request->validate([
"hinh_thuc_thanh_toan"=>["required","numeric"]
]);
$data = [];
$quantity = [];
if(session()->has('cart'))
{
$order = ["ngay_dat_hang"=>DB::raw("now()"),"tinh_trang"=>1,
"hinh_thuc_thanh_toan"=>$request->hinh_thuc_thanh_toan,
"user_id"=>Auth::user()->id];
DB::transaction(function () use ($order) {
$id_don_hang = DB::table("order")->insertGetId($order);
$cart = session("cart");
$list_product = "";
$quantity = [];
foreach($cart as $id=>$value)
{
$quantity[$id] = $value;
$list_product .=$id.", ";
}
$list_product = substr($list_product, 0,strlen($list_product)-2);
$data = DB::table("products")->whereRaw("id in (".$list_product.")")->get();
$detail = [];
foreach($data as $row)
{
$detail[] = ["order_id"=>$id_don_hang,"product_id"=>$row->id,
"quantity"=>$quantity[$row->id],"price"=>$row->gia_ban];
}
DB::table("order_details")->insert($detail);
session()->forget('cart');
});
}
return view("vidumon.order", compact('data','quantity'));
}

public function productview(Request $request)
{
$the_loai = $request->input("loai_mon");
$data = [];
if($loai_mon!="")
$data = DB::select("select * from products where id_category = ?",[$the_loai]);
else
$data = DB::select("select * from products order by price asc limit 0,10");
return view("vidumon.productview", compact("data"));
}

//Hàm xử lý đặt bàn
public function tableList()
{
    $tables = Table::all();
    $positions = Table::distinct()->pluck('position');
    return view('booking.table', compact('tables', 'positions'));
}

public function submitTable(Request $request)
{
$request->validate([
    'selected_type' => 'required',
    'selected_table' => 'required',
    'seating_capacity' => 'required|integer',
]);

Session::put('booking_data', [
    'type' => $request->selected_type,
    'table' => $request->selected_table,
    'seats' => $request->seating_capacity,
]);

return response()->json(['success' => true]);
}
}