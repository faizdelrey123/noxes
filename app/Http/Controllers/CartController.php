<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;

class CartController extends Controller
{
    public function index()
{
    $cart = session('cart', []);

    $selectedAddressId = session('selected_address');

    $selectedAddress = null;

    if ($selectedAddressId) {
        $selectedAddress = Address::find($selectedAddressId);
    }

    return view('user.cart', compact('cart', 'selectedAddress'));
}

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
    'id' => $product->id, // WAJIB TAMBAH INI
    'name' => $product->name,
    'price' => $product->price,
    'image' => $product->image,
    'quantity' => 1
];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        $cart[$id]["quantity"] = $request->quantity;

        session()->put('cart', $cart);

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }
}