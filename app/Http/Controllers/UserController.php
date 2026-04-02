<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserController extends Controller
{
    // =============================
    // DASHBOARD (HOME USER)
    // =============================
    public function dashboard()
    {
        return view('user.home');
    }

    // =============================
    // PROFILE + PESANAN
    // =============================
    public function profile(Request $request)
{
    $status = $request->status ?? 'tertunda';

    // mapping URL → database
    $map = [
        'tertunda' => 'tertunda',
        'packed' => 'dikemas',
        'shipped' => 'dikirim',
        'done' => 'selesai'
    ];

    $dbStatus = $map[$status] ?? 'tertunda';

    // ambil order sesuai status
    $orders = Order::with('items.product')
        ->where('user_id', auth()->id())
        ->where('status', $dbStatus)
        ->latest()
        ->get();

    // 🔥 TAMBAHAN PENTING (BIAR BADGE JUMLAH MUNCUL)
    $counts = [
        'tertunda' => Order::where('user_id', auth()->id())->where('status', 'tertunda')->count(),
        'packed'   => Order::where('user_id', auth()->id())->where('status', 'dikemas')->count(),
        'shipped'  => Order::where('user_id', auth()->id())->where('status', 'dikirim')->count(),
        'done'     => Order::where('user_id', auth()->id())->where('status', 'selesai')->count(),
    ];

    // 🔥 WAJIB kirim counts ke view
    return view('user.profile', compact('orders', 'status', 'counts'));
}
}