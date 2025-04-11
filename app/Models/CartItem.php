<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $size       = $request->input('size');
        $sugar      = $request->input('sugar');
        $ice        = $request->input('ice');
        $quantity   = $request->input('quantity', 1);

       
        $product = new Product([
        ]);

        $cartItem = new CartItem([
            'product_id' => $product_id,
            'size'       => $size,
            'sugar'      => $sugar,
            'ice'        => $ice,
            'quantity'   => $quantity,
        ]);

        $cart = session()->get('cart', []);
        $cart[] = $cartItem; 
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng!');
    }
}
