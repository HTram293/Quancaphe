<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ViDuController extends Controller
{
    //
    function vidu2(){
        return view('vidu2');
        }
    function tinhtong(Request $request)
{
$so_a = $request->input("so_a");
$so_b = $request->input("so_b");
$ket_qua = $so_a+$so_b;
return "Kết quả là: ".$ket_qua;
}
function theloai($id)
{
$data = DB::select("select * from sach where id_the_loai = ?",[$id]);
return view("vidusach.index", compact("data"));
}
}