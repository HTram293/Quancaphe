<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
    {
        //
        function create()
        {
            return view('add_category');
        }
    
        function store(Request $request)
        {
            $id = $request->input('id');
            $ten_the_loai = $request->input('ten_the_loai');
    
            DB::table('the_loai')->insert([
                'id' => $id,
                'ten_the_loai' => $ten_the_loai,
            ]);
    
            return redirect('/add_category')->with('success', 'Thể loại đã được thêm thành công!');
        }
    

    function creates()
    {
        return view('add_categories');
    }

    function stores(Request $request)
    {
        $categories = [];
        for ($i = 0; $i < count($request->input('id')); $i++) {
            $categories[] = [
                'id' => $request->input('id')[$i],
                'ten_the_loai' => $request->input('ten_the_loai')[$i],
            ];
        }

        DB::table('the_loai')->insert($categories);

        return redirect('/add_categories')->with('success', 'Các thể loại đã được thêm thành công!');
    }
    }