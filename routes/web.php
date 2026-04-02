<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('user.home');
})->name('home');

// ABOUT
Route::get('/about', function () {
    return view('user.about');
})->name('about');

// CONTACT
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| PRODUCT USER
|--------------------------------------------------------------------------
*/

Route::get('/product', [ProductController::class, 'userProducts'])
    ->name('product.index');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.detail');

Route::get('/product/series/{series}', [ProductController::class, 'bySeries'])
    ->name('product.series');


/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showUserLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginUser']);


/*
|--------------------------------------------------------------------------
| AUTH STAFF (PENTING: GET + POST)
|--------------------------------------------------------------------------
*/

Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])
    ->name('staff.login');

Route::post('/staff/login', [AuthController::class, 'loginStaff']);


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| ADDRESS
|--------------------------------------------------------------------------
*/

Route::get('/alamat', [AddressController::class, 'index'])->name('alamat.index');
Route::get('/alamat/create', [AddressController::class, 'create'])->name('alamat.create');
Route::post('/alamat/store', [AddressController::class, 'store'])->name('alamat.store');
Route::post('/alamat/select/{id}', [AddressController::class, 'select'])->name('alamat.select');
Route::delete('/alamat/{id}', [AddressController::class, 'destroy'])->name('alamat.destroy');


/*
|--------------------------------------------------------------------------
| PROTECTED (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // DASHBOARD USER
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])
        ->name('user.dashboard');

    // PROFILE
    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    /*
    |--------------------------------------------------------------------------
    | ORDER USER
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/orders/{id}/struk', [OrderController::class, 'struk'])
        ->name('orders.struk');

});


/*
|--------------------------------------------------------------------------
| ADMIN / PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // DASHBOARD PETUGAS
    Route::get('/staff/dashboard', [PetugasController::class, 'dashboard'])
        ->name('staff.dashboard');

    // STATUS PESANAN (SETELAH APPROVE)
    Route::get('/staff/status', [PetugasController::class, 'statusPesanan'])
        ->name('staff.status');

    // APPROVE PESANAN (DARI DASHBOARD)
    Route::post('/staff/approve/{id}', [PetugasController::class, 'approve'])
        ->name('staff.approve');

    // DETAIL PESANAN STAFF
    Route::get('/staff/orders/{id}', [PetugasController::class, 'showOrder'])
        ->name('staff.orders.show');

    // LAPORAN STAFF
    Route::get('/staff/laporan', [PetugasController::class, 'laporan'])
        ->name('staff.laporan');
    Route::get('/staff/laporan/export', [PetugasController::class, 'exportExcel'])
        ->name('staff.laporan.export');

    // UPDATE STATUS (DIKEMAS → DIKIRIM → SELESAI)
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

});


/*
|--------------------------------------------------------------------------
| ADMIN PRODUK
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/product', [ProductController::class, 'index'])
        ->name('admin.product.index');

    Route::get('/product/create', [ProductController::class, 'create'])
        ->name('admin.product.create');

    Route::post('/product', [ProductController::class, 'store'])
        ->name('admin.product.store');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])
        ->name('admin.product.edit');

    Route::put('/product/{id}', [ProductController::class, 'update'])
        ->name('admin.product.update');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])
        ->name('admin.product.destroy');
});


/*
|--------------------------------------------------------------------------
| DEBUG
|--------------------------------------------------------------------------
*/

Route::get('/reset-cart', function () {
    session()->forget('cart');
    return "Cart direset!";
});

Route::get('/staff/riwayat', [PetugasController::class, 'riwayat'])
    ->name('staff.riwayat');

Route::middleware(['auth'])->group(function () {

    Route::get('/staff/product', [ProductController::class, 'index'])
        ->name('staff.product.index');

    Route::get('/staff/product/create', [ProductController::class, 'create'])
        ->name('staff.product.create');

    Route::post('/staff/product', [ProductController::class, 'store'])
        ->name('staff.product.store');

    Route::get('/staff/product/{id}/edit', [ProductController::class, 'edit'])
        ->name('staff.product.edit');

    Route::put('/staff/product/{id}', [ProductController::class, 'update'])
        ->name('staff.product.update');

    Route::delete('/staff/product/{id}', [ProductController::class, 'destroy'])
        ->name('staff.product.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [PetugasController::class, 'adminDashboard'])->name('admin.dashboard');

    // KELOLA PETUGAS
    Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');
    Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.petugas.destroy');

    // KELOLA PENGGUNA
    Route::get('/users', [PetugasController::class, 'userIndex'])->name('admin.user.index');
    Route::get('/users/{id}', [PetugasController::class, 'userShow'])->name('admin.user.show');
    Route::delete('/users/{id}', [PetugasController::class, 'userDestroy'])->name('admin.user.destroy');

});