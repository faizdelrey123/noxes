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

        return redirect()->route('admin.petugas.index')
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

    public function adminDashboard()
    {
        // 🔥 HITUNG DATA
        $totalPendapatan = Order::where('status', 'selesai')->sum('total');
        $totalOrder = Order::count();
        $totalProduk = Product::count();
        $totalUser = User::where('role', 'user')->count();

        // 🔥 ORDER TERBARU
        $orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalOrder',
            'totalProduk',
            'totalUser',
            'orders'
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

    /*
    |----------------------------------------
    | KELOLA PENGGUNA (ROLE: USER)
    |----------------------------------------
    */
    public function userIndex()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user.index', compact('users'));
    }

    public function userShow($id)
    {
        $user = User::withCount('orders')->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function userDestroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Pengguna berhasil dihapus');
    }

    public function showOrder($id)
    {
        $order = Order::with('items.product', 'address', 'user')
            ->findOrFail($id);

        $subtotal = collect($order->items)->sum(function($item){
            return $item->price * $item->quantity;
        });

        $ongkir = 10000;

        return view('staff.order_detail', compact('order', 'subtotal', 'ongkir'));
    }

    public function laporan(Request $request)
    {
        $query = Order::with('user', 'items')->where('status', 'selesai');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $orders = $query->latest()->get();
        $total_pendapatan = $orders->sum('total');
        $total_order = $orders->count();

        return view('staff.laporan', compact('orders', 'total_pendapatan', 'total_order'));
    }

    public function exportExcel(Request $request)
    {
        $query = Order::with('user')->where('status', 'selesai');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $orders = $query->latest()->get();
        
        $filename = "Laporan_Penjualan_" . date('Y-m-d') . ".csv";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array('ID Order', 'Customer', 'Tanggal', 'Items', 'Total'));

            foreach ($orders as $order) {
                fputcsv($file, array(
                    $order->order_code,
                    $user_name = $order->user ? $order->user->name : 'N/A',
                    $order->created_at->format('d/m/Y'),
                    $order->items->count(),
                    $order->total
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}