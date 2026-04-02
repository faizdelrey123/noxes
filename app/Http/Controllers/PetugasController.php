<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Product;

class PetugasController extends Controller
{
    /*
    |----------------------------------------
    | KELOLA PETUGAS
    |----------------------------------------
    */
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil dibuat');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }

    /*
    |----------------------------------------
    | DASHBOARD PETUGAS
    |----------------------------------------
    */
    public function dashboard()
    {
        // 🔥 HITUNG DATA
        $totalPendapatan = Order::where('status', 'selesai')->sum('total');
        $totalOrder = Order::count();
        $totalProduk = Product::count();

        // 🔥 ORDER YANG MENUNGGU APPROVE
        $pendingOrders = Order::with('user')
            ->where('status', 'tertunda')
            ->latest()
            ->get();

        return view('staff.dashboard', compact(
            'totalPendapatan',
            'totalOrder',
            'totalProduk',
            'pendingOrders'
        ));
    }

    /*
    |----------------------------------------
    | APPROVE PESANAN
    |----------------------------------------
    */
    public function approve($id)
    {
        $order = Order::findOrFail($id);

        // dari tertunda → dikemas
        $order->status = 'dikemas';
        $order->save();

        return back()->with('success', 'Pesanan berhasil di-approve');
    }

    /*
    |----------------------------------------
    | STATUS PESANAN (SETELAH APPROVE)
    |----------------------------------------
    */
    public function statusPesanan()
    {
        // ❗ hanya tampilkan yang SUDAH DI-APPROVE
        $orders = Order::with('user', 'items')
            ->whereIn('status', ['dikemas', 'dikirim', 'selesai'])
            ->latest()
            ->get();

        return view('staff.status', compact('orders'));
    }

    public function riwayat(Request $request)
{
    $filter = $request->filter;

    $query = Order::with('user');

    // FILTER HARIAN
    if ($filter == 'harian') {
        $query->whereDate('created_at', now());
    }

    // FILTER BULANAN
    if ($filter == 'bulanan') {
        $query->whereMonth('created_at', now()->month);
    }

    // hanya tampilkan yang SUDAH diproses
    $orders = $query->whereIn('status', ['dikemas','dikirim','selesai'])
        ->latest()
        ->get();

    return view('staff.riwayat', compact('orders','filter'));
}
}