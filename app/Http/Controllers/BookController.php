<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Category;
class BookController extends Controller
{
    //
    function laythongtintheloai()
    {
    $the_loai_sach = Category::all();
    return view("qlsach.the_loai",compact("the_loai_sach"));
    }
    function themtheloai()
    {
        $data = ["id"=>4,"ten_the_loai"=>"Trinh thám"];
        DB::table("the_loai")->insert($data);
    
    // Thông báo thành công và chuyển hướng (hoặc trả về view)
    return redirect()->back()->with('success', 'Thể loại đã được thêm thành công!'); 
    }
    function laythongtinsach()
    {
    $sach = Book::where("nha_xuat_ban","Văn Học")->get();
    return view("qlsach.thong_tin_sach",compact("sach"));
    }
}

