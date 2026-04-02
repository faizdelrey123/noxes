<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;

class CheckoutController extends Controller
{
    // ===============================
    // HALAMAN CHECKOUT
    // ===============================
    public function index()
    {
        $cart = session('cart', []);

        // Ambil alamat dari session
        $selectedAddressId = session('selected_address');
       $address = Address::find($selectedAddressId);

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $ongkir = 10000;
        $grandTotal = $total + $ongkir;

        return view('checkout', compact(
            'cart',
            'total',
            'ongkir',
            'grandTotal',
            'address'
        ));
    }


    // ===============================
    // SIMPAN PESANAN
    // ===============================
    public function store(Request $request)
    {
        $cart = session('cart', []);

        // VALIDASI
        if (!$request->shipping || !$request->payment) {
            return redirect()->back()->with('error', 'Pilih opsi terlebih dahulu');
        }

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        // Ambil alamat
        $selectedAddressId = session('selected_address');

        if (!$selectedAddressId) {
            return redirect()->route('cart.index')
                ->with('error', 'Alamat belum dipilih');
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $ongkir = 10000;
        $grandTotal = $total + $ongkir;

        // Upload bukti pembayaran
        $proofPath = null;

if ($request->hasFile('proof')) {

    $file = $request->file('proof');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('proofs'), $filename);

    $proofPath = 'proofs/' . $filename; // simpan path
}

        // SIMPAN ORDER
        $order = Order::create([
    'user_id' => Auth::id(),
    'address_id' => $selectedAddressId,
    'shipping' => $request->shipping,
    'payment' => $request->payment,
    'total' => $grandTotal,
    'proof' => $proofPath,
    'status' => 'tertunda', // 🔥 INI YANG PENTING
]);

        // SIMPAN ORDER ITEMS
        foreach ($cart as $item) {

    if (!isset($item['id'])) continue; // skip kalau data lama

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $item['id'],
        'quantity' => $item['quantity'],
        'price' => $item['price']
    ]);
}

        // HAPUS CART
        session()->forget('cart');

        return redirect()->route('profile')
    ->with('success', 'Pesanan berhasil dibuat');

    if (empty($cart)) {
    return redirect()->route('cart.index');
}
    }
}