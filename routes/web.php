<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailJualController;
use App\Http\Controllers\DetailPesanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LapStokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('akun', AkunController::class);
        Route::resource('setting', SettingController::class);
    });

    // Pemesanan
    Route::resource('pemesanan', PemesananController::class)->only(['index', 'store']);
    Route::get('pemesanan/{pemesanan}/destroy', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    Route::resource('detail', DetailPesanController::class);

    Route::resource('pembelian', PembelianController::class);
    Route::get('pembelian/{pembelian}/pdf', [PembelianController::class, 'pdf'])->name('pembelian.pdf');

    Route::resource('penjualan', PenjualanController::class);
    Route::resource('detail-jual', DetailJualController::class);
    Route::get('penjualan/{penjualan}/pdf', [PenjualanController::class, 'pdf'])->name('penjualan.pdf');

    Route::resource('retur', ReturController::class);

    Route::resource('laporan', LaporanController::class);
    Route::resource('stok', LapStokController::class);
});
