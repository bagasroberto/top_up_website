<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MainAdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [MainController::class, 'index'])->name('dashboard');
    Route::get('/produk', [MainController::class, 'indexProduk'])->name('produk');
    Route::get('/produk/detail-produk/{id}', [MainController::class, 'showProduct'])->name('produk.detail');
    Route::post('/pembelian-diamond', [OrderController::class, 'storeProduct'])->name('submit.order');
    Route::get('/status-pesanan', [MainController::class, 'indexPesanan'])->name('pesanan.index');

    Route::get('order/{order}/payment', [OrderController::class, 'paymentPage'])->name('orders.payment');
    Route::post('order/{order}/pay', [OrderController::class, 'processPayment'])->name('orders.pay');
    Route::get('/produk/cari/{category}', [MainController::class, 'search'])->name('produk.search');


});

Route::get('/homepage-admin', [MainAdminController::class, 'index'])->name('dashboard.admin');

Route::get('/loginadmin', [MainAdminController::class, 'loginindex'])->name('login.admin');
Route::get('/admin/katalog', [MainAdminController::class, 'katalogAdmin'])->name('katalog.admin');
Route::get('/admin/pembelian', [MainAdminController::class, 'pembelianAdmin'])->name('pembelian.admin');
Route::put('/pesanan/{id}/update', [OrderController::class, 'updatePesanan'])->name('pesanan.update');

Route::post('/katalog-store', [MainAdminController::class, 'storeKatalogAdmin'])->name('katalog.store');
Route::get('/katalog/edit/{id}', [MainAdminController::class, 'editKatalogAdmin'])->name('katalog.edit');
Route::post('/katalog/update/{id}', [MainAdminController::class, 'updateKatalogAdmin'])->name('katalog.update');
Route::delete('/katalog/delete/{id}', [MainAdminController::class, 'deleteKatalogAdmin'])->name('katalog.delete');
Route::put('/katalog/update/{id}', [MainAdminController::class, 'updateKatalog'])->name('katalog.update');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
