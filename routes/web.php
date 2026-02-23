<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;

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
        return view('profile');
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