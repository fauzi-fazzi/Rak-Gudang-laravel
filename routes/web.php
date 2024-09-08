<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'auth']);

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('barang/import', [ExcelController::class, 'import'])->name('import');
    Route::get('barang/export', [ExcelController::class, 'export'])->name('export');
    Route::delete('/barang/reset', [ExcelController::class, 'reset'])->name('barang.reset');

    Route::get('rak/{id}/create', [BarangController::class, 'create']);
    Route::post('rak/{id}/store', [BarangController::class, 'store']);
    Route::get('rak/{rak}/edit/{barangId}', [BarangController::class, 'edit']);
    Route::put('rak/{rak}/update/{barangId}', [BarangController::class, 'update']);
    Route::delete('barang/{barangId}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // master
    Route::get('/master/rak', [MasterController::class, 'rak'])->name('master.rak');
    Route::post('/master/rak/store', [MasterController::class, 'rak_store'])->name('rak.store');
    Route::delete('master/rak/{id}', [MasterController::class, 'rak_destroy'])->name('rak.destroy');

    Route::get('/master/vendor', [MasterController::class, 'vendor'])->name('master.vendor');
    Route::post('/master/vendor/store', [MasterController::class, 'vendor_store'])->name('vendor.store');
    Route::delete('master/vendor/{id}', [MasterController::class, 'vendor_destroy'])->name('vendor.destroy');

    Route::get('/master/kategori', [MasterController::class, 'kategori'])->name('master.kategori');
    Route::post('/master/kategori/store', [MasterController::class, 'kategori_store'])->name('kategori.store');
    Route::delete('master/kategori/{id}', [MasterController::class, 'kategori_destroy'])->name('kategori.destroy');

    Route::get('/master/satuan', [MasterController::class, 'satuan'])->name('master.satuan');
    Route::post('/master/satuan/store', [MasterController::class, 'satuan_store'])->name('satuan.store');
    Route::delete('master/satuan/{id}', [MasterController::class, 'satuan_destroy'])->name('satuan.destroy');
});

Route::get('rak', [RakController::class, 'index']);
Route::get('rak/{id}', [RakController::class, 'show']);
Route::get('barang/search', [RakController::class, 'search'])->name('search');


Route::get('cek', function () {
    // Auth::logout();
    dd(Auth::user());
});
