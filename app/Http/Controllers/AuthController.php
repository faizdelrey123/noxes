<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showUserLogin()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN USER (ROLE = USER)
    |--------------------------------------------------------------------------
    */

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard');
            }

            Auth::logout();
            return back()->with('error', 'Akun ini bukan user.');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    /*
    |--------------------------------------------------------------------------
    | STAFF LOGIN PAGE (ADMIN & PETUGAS)
    |--------------------------------------------------------------------------
    */

    public function showStaffLogin()
    {
        return view('auth.login_staff');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN STAFF
    |--------------------------------------------------------------------------
    */

    public function loginStaff(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $role = Auth::user()->role;

            if (auth()->user()->role == 'admin') {
    return redirect('/admin/dashboard');
}

if (auth()->user()->role == 'petugas') {
    return redirect()->route('staff.dashboard');
}
            Auth::logout();
            return back()->with('error', 'Bukan akun staff.');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER USER (DEFAULT ROLE USER)
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
{
    $role = Auth::user()->role; // simpan role dulu

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect sesuai role sebelumnya
    if ($role === 'admin' || $role === 'petugas') {
        return redirect()->route('staff.login');
    }

    return redirect()->route('login');
}

}
