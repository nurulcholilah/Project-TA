<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pemasukan', PemasukanController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('kategori', KategoriController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('saldo', SaldoController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('pengeluaran', PengeluaranController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::get('pengeluaran/{id_pengeluaran}', 'PengeluaranController@show')->name('pengeluaran.show')->middleware(['auth', 'verified', 'role:admin']);
});

Route::middleware(['auth', 'verified', 'role:pegawai'])->group(function () {
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
});

// Route::get('admin', function () {
//     return '<h1>Admin</h1>';
// })->middleware(['auth', 'verified', 'role:admin']);

// Route::get('pegawai', function () {
//     return '<h1>Pegawai</h1>';
// })->middleware(['auth', 'verified', 'role:pegawai|admin']);

// Route::get('tulisan', function () {
//     return view('olin');
// })->middleware(['auth', 'verified', 'role_or_permission:lihat-pengajuan|admin']);

require __DIR__ . '/auth.php';
