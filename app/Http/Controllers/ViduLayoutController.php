<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViduLayoutController extends Controller
{
    //
    
        function trang1()
        {
        return view("vidulayout.trang1");
        }    
        function sach()
{
$data = DB::select("select * from sach order by gia_ban asc limit 0,8");
return view("vidusach.index", compact("data"));
}  
function chitiet($id)
{ 
    $data = DB::select("select * from sach where id = ?",[$id]) [0];
return view("vidusach.chitiet", compact("data"));
}
}
