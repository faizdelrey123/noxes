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

    // AMBIL ID PESANAN YANG BELUM DIBACA UNTUK NOTIFIKASI
    $unnotified_ids = Order::where('user_id', auth()->id())
        ->where('is_notified', false)
        ->pluck('id')
        ->toArray();

    // CLEAR BADGE NOTIFICATIONS (Sehingga badge navbar hilang saat halaman ini dimuat)
    if (count($unnotified_ids) > 0) {
        Order::whereIn('id', $unnotified_ids)->update(['is_notified' => true]);
    }

    // 🔥 WAJIB kirim counts ke view
    return view('user.profile', compact('orders', 'status', 'counts', 'unnotified_ids'));
}
}