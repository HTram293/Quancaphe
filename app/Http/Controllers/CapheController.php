<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\CapheController;
use Illuminate\Support\Facades\Auth;

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
    $request->validate([
        'id' => 'required|numeric',
        'num' => 'required|numeric',
    ]);

    $id = $request->id;
    $num = $request->num;

    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id] += $num;
    } else {
        $cart[$id] = $num;
    }

    session()->put('cart', $cart);
    return response()->json(count($cart));
}

public function order()
    {
        $cart=[];
        $data =[];
        $quantity = [];
    if(session()->has('cart'))
    {
        $cart = session("cart");
        $list_product = "";
    foreach($cart as $id=>$value)
    {
        $quantity[$id] = $value;
        $list_product .=$id.", ";
    }
        $list_product = substr($list_product, 0,strlen($list_product)-2);
        if($list_product!="")
            $data = DB::table("products")->whereRaw("id in (".$list_product.")")->get();
        else
            $data = [];
    }
    return view("vidumon.order",compact("quantity","data"));
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
    $the_loai = $request->input('loai_mon');
    $data = [];

    if ($the_loai != "") {
        $data = Product::where('id_category', $the_loai)->get();
    } else {
        $data = Product::orderBy('price', 'asc')->limit(10)->get();
    }

    return view('vidumon.productview', compact('data'));
}

public function index()
{
    // Fetch all products from the database
    $data = Product::all();

    // Pass the products to the view
    return view('vidumon.index', compact('data'));
}
}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('vidumon.index', compact('products'));
    }
}

// app/Http/Controllers/CapheController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CapheController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('vidumon.index', compact('products'));
    }
}

// Add the route for CapheController index method
Route::get('/vidumon', [CapheController::class, 'index']);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class VidumonController extends Controller
{
    public function index() {
        $data = DB::table('products')->get(); // hoặc Model Product::all();
        return view('vidumon.index', ['data' => $data]);
    }
    }
    