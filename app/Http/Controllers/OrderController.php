<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // CLEAR BADGE NOTIFICATIONS
        \App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->update(['is_notified' => true]);

        $query = Order::with('items.product')->where('user_id', Auth::id());

        // FILTER TANGGAL
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // FILTER BULAN
        if ($request->month) {
            $query->whereMonth('created_at', $request->month);
        }

        $orders = $query->latest()->get();

        return view('user.orders', compact('orders'));
    }

    public function profile(Request $request)
{
    // CLEAR BADGE NOTIFICATIONS
    \App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->update(['is_notified' => true]);

    $status = $request->status ?? 'tertunda';

    $map = [
        'tertunda' => 'tertunda',
        'packed' => 'dikemas',
        'shipped' => 'dikirim',
        'done' => 'selesai'
    ];

    $dbStatus = $map[$status] ?? 'tertunda';

    $orders = \App\Models\Order::with('items.product')
        ->where('user_id', auth()->id())
        ->where('status', $dbStatus)
        ->latest()
        ->get();

    // 🔥 COUNT UNTUK BADGE
    $counts = [
        'tertunda' => \App\Models\Order::where('user_id', auth()->id())->where('status', 'tertunda')->count(),
        'packed'   => \App\Models\Order::where('user_id', auth()->id())->where('status', 'dikemas')->count(),
        'shipped'  => \App\Models\Order::where('user_id', auth()->id())->where('status', 'dikirim')->count(),
        'done'     => \App\Models\Order::where('user_id', auth()->id())->where('status', 'selesai')->count(),
    ];

    return view('user.profile', compact('orders', 'status', 'counts'));
}

    public function struk($id)
    {
        $order = Order::with('items.product', 'address')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.struk', compact('order'));
    }
    public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    if ($order->is_received) {
        return back()->with('error', 'Pesanan tidak dapat diubah karena telah diterima oleh pengguna.');
    }

    if ($request->has('status')) {
        $order->status = $request->status;
    }
    
    if ($request->has('tracking_level')) {
        $order->tracking_level = $request->tracking_level;
    }

    $order->is_notified = false; // set badge untuk user
    $order->save();

    return back()->with('success', 'Status dan pelacakan pesanan berhasil diupdate');
}

public function show($id)
{
    $order = \App\Models\Order::with('items.product', 'address', 'user')
        ->findOrFail($id);

    // hitung subtotal
    $subtotal = $order->items->sum(function($item){
        return $item->price * $item->quantity;
    });

    // ongkir (contoh)
    $ongkir = 15000;

    return view('user.order_detail', compact('order','subtotal','ongkir'));
}

    public function receiveOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status == 'selesai' && !$order->is_received) {
            $order->is_received = true;
            $order->tracking_level = 5; // Set tracking to 'Diterima'
            $order->save();
        }

        return back()->with('success', 'Pesanan telah diterima');
    }
}