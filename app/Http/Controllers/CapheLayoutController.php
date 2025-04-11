<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CapheLayoutController extends Controller
{
        function trang1()
{
        return view("vidulayout.trang1");
}
function mon()
{
$data = DB::select("select * from products order by price asc limit 0,8");
return view("vidumon.index", compact("data"));
}
function loaimon($id)
{
$data = DB::select("select * from products where id_category = ?",[$id]);
return view("vidumon.index", compact("data"));
}
public function chitiet($id)
{
    $data = Product::find($id); 
    if (!$data) {
        abort(404, 'Product not found'); 
    }
    return view('vidumon.chitiet', compact('data'));
}
}
