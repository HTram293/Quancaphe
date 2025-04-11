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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|in:S,M,L',
            'quantity' => 'required|integer|min:1',
        ]);

        $product_id = $request->input('product_id');
        $size       = $request->input('size');
        $sugar      = $request->input('sugar');
        $ice        = $request->input('ice');
        $quantity   = $request->input('quantity', 1);

        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'size'       => $size,
            'sugar'      => $sugar,
            'ice'        => $ice,
            'quantity'   => $quantity,
            'price'      => $product->price,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
}