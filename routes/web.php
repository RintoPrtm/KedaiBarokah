<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\PesananUserController;
use App\Http\Controllers\Admin\WarungController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\KategoriController;

// Auth routes User
Route::middleware(['rule'])->group(function () {
    // Tampilan utama user
    Route::get('tampilUser', [MainController::class, 'tampilUser']);
    Route::get('warungUser', [MainController::class, 'warungUser']);
    Route::get('kategoriUser/{id_kategori}', [MainController::class, 'menuUser']);

    // Keranjang user
    Route::get('keranjang', [KeranjangController::class, 'index']);
    Route::get('/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang.index');
    Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('keranjang.add');
    Route::post('/keranjang/kurangi', [KeranjangController::class, 'kurangi'])->name('keranjang.kurangi');
    Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
    Route::delete('/keranjang/remove/{id_detail}', [KeranjangController::class, 'remove'])->name('keranjang.remove');

    // Pesanan user
    Route::get('pesanan', [PesananUserController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{pesanan}', [PesananUserController::class, 'show'])->name('pesanan.show');
    Route::get('/pesananSukses/{id_pesanan}', [KeranjangController::class, 'pesananSukses'])->name('pesanan.sukses');
});

// Auth routes Admin
Route::middleware(['rule'])->group(function (){
    Route::get('admin', [KategoriController::class, 'index']);

    Route::resource('admin/kategori', KategoriController::class)
    ->only(['index','store','update','destroy'])
    ->names([
        'index' => 'admin.kategori.index',
        'store' => 'admin.kategori.store',
        'update'  => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

    Route::resource('menuAdmin', MenuController::class)
    ->only(['index','store','update','destroy'])
    ->names([
        'index' => 'admin.menu.index',
        'store'   => 'admin.menu.store',
        'update'  => 'admin.menu.update',
        'destroy' => 'admin.menu.destroy',
    ])->parameters(['menuAdmin'=>'menu']);
    
    Route::get('pesananAdmin', [PesananController::class, 'pesananAdmin']);
    Route::put('admin/pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])
        ->name('admin.pesanan.updateStatus');

    Route::get('warungAdmin', [WarungController::class, 'warungAdmin']);
    Route::put('admin/warung/{warung}', [WarungController::class, 'update'])
        ->name('admin.warung.update');

    
    Route::get('/invoice/{id}', [InvoiceController::class, 'generate'])->name('invoice.generate');
});


// Auth routes Guest
Route::middleware(['guest.custom'])->group(function (){
    Route::get('/', [MainController::class, 'index']);
    Route::get('main', [MainController::class, 'index']);
    Route::get('warung', [MainController::class, 'warung']);

    Route::get('/kategori/{id_kategori}', [MainController::class, 'menu']);

    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/masuk', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'ShowRegisterForm'])->name('register');
    Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');






    

    

    
