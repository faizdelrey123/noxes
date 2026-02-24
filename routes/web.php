<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('user.home');
})->name('home');

// PRODUCT
Route::get('/product', function () {
    return view('user.products.index');
})->name('index');

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
| USER PRODUCT VIEW (PUBLIC)
|--------------------------------------------------------------------------
*/

// LIST PRODUK USER
Route::get('/product', [ProductController::class, 'userProducts'])
    ->name('product.index');

// DETAIL PRODUK
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.detail');

// FILTER SERIES
Route::get('/product/series/{series}', [ProductController::class, 'bySeries'])
    ->name('product.series');


/*
|--------------------------------------------------------------------------
| USER LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showUserLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginUser']);


/*
|--------------------------------------------------------------------------
| STAFF LOGIN (ADMIN & PETUGAS)
|--------------------------------------------------------------------------
*/

Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])
    ->name('staff.login');

Route::post('/staff/login', [AuthController::class, 'loginStaff']);


/*
|--------------------------------------------------------------------------
| REGISTER (USER ONLY)
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // =============================
    // DASHBOARD
    // =============================

    // Dashboard User
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])
        ->name('user.dashboard');

    // Dashboard Staff
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // Profile
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');


    /*
    |--------------------------------------------------------------------------
    | ADMIN & PETUGAS - KELOLA PRODUK
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->group(function () {

        // LIST PRODUK (ADMIN)
        Route::get('/product', [ProductController::class, 'index'])
            ->name('admin.product.index');

        // FORM TAMBAH
        Route::get('/product/create', [ProductController::class, 'create'])
            ->name('admin.product.create');

        // SIMPAN
        Route::post('/product', [ProductController::class, 'store'])
            ->name('admin.product.store');

        // FORM EDIT
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])
            ->name('admin.product.edit');

        // UPDATE
        Route::put('/product/{id}', [ProductController::class, 'update'])
            ->name('admin.product.update');

        // HAPUS
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])
            ->name('admin.product.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | KELOLA PETUGAS (ADMIN ONLY)
    |--------------------------------------------------------------------------
    */

    Route::get('/kelola-petugas', [PetugasController::class, 'index'])
        ->name('petugas.index');

    Route::get('/kelola-petugas/create', [PetugasController::class, 'create'])
        ->name('petugas.create');

    Route::post('/kelola-petugas', [PetugasController::class, 'store'])
        ->name('petugas.store');

    Route::delete('/kelola-petugas/{id}', [PetugasController::class, 'destroy'])
        ->name('petugas.destroy');

});

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

Route::get('/alamat', [App\Http\Controllers\AddressController::class, 'index'])
    ->name('alamat.index');

Route::get('/alamat/create', [App\Http\Controllers\AddressController::class, 'create'])
    ->name('alamat.create');

Route::post('/alamat/store', [App\Http\Controllers\AddressController::class, 'store'])
    ->name('alamat.store');

Route::post('/alamat/select/{id}', [App\Http\Controllers\AddressController::class, 'select'])
    ->name('alamat.select');

    Route::delete('/alamat/{id}', [AddressController::class, 'destroy'])
    ->name('alamat.destroy');