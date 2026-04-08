<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\User;

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

        $map = [
            'tertunda' => 'tertunda',
            'packed'   => 'dikemas',
            'shipped'  => 'dikirim',
            'done'     => 'selesai'
        ];

        $dbStatus = $map[$status] ?? 'tertunda';

        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', $dbStatus)
            ->latest()
            ->get();

        $counts = [
            'tertunda' => Order::where('user_id', auth()->id())->where('status', 'tertunda')->count(),
            'packed'   => Order::where('user_id', auth()->id())->where('status', 'dikemas')->count(),
            'shipped'  => Order::where('user_id', auth()->id())->where('status', 'dikirim')->count(),
            'done'     => Order::where('user_id', auth()->id())->where('status', 'selesai')->count(),
        ];

        $unnotified_ids = Order::where('user_id', auth()->id())
            ->where('is_notified', false)
            ->pluck('id')
            ->toArray();

        if (count($unnotified_ids) > 0) {
            Order::whereIn('id', $unnotified_ids)->update(['is_notified' => true]);
        }

        return view('user.profile', compact('orders', 'status', 'counts', 'unnotified_ids'));
    }

    // =============================
    // UPDATE PROFILE
    // =============================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email'    => 'nullable|email|max:100|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
        ]);

        User::where('id', $user->id)->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // =============================
    // GANTI PASSWORD
    // =============================
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.'])->with('open_password_modal', true);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diubah!');
    }
}